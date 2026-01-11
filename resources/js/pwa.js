// PWA Installation and Service Worker Registration

let deferredPrompt;
let isInstalled = false;

// Check if app is already installed
if (window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone === true) {
  isInstalled = true;
  console.log('[PWA] App is running in standalone mode');
}

// Register service worker
if ('serviceWorker' in navigator) {
  window.addEventListener('load', () => {
    navigator.serviceWorker
      .register('/service-worker.js')
      .then((registration) => {
        console.log('[PWA] Service Worker registered:', registration);

        // Check for updates every hour
        setInterval(() => {
          registration.update();
        }, 60 * 60 * 1000);
      })
      .catch((error) => {
        console.error('[PWA] Service Worker registration failed:', error);
      });
  });
}

// Listen for install prompt
window.addEventListener('beforeinstallprompt', (e) => {
  console.log('[PWA] Install prompt fired');
  
  // Prevent the default install prompt
  e.preventDefault();
  
  // Store the event for later use
  deferredPrompt = e;
  
  // Show custom install button
  showInstallButton();
});

// Show install button
function showInstallButton() {
  const installButton = document.getElementById('pwa-install-btn');
  if (installButton && !isInstalled) {
    installButton.style.display = 'block';
    installButton.classList.add('animate-bounce-in');
  }
}

// Install button click handler
window.addEventListener('DOMContentLoaded', () => {
  const installButton = document.getElementById('pwa-install-btn');
  
  if (installButton) {
    installButton.addEventListener('click', async () => {
      if (!deferredPrompt) {
        console.log('[PWA] Install prompt not available');
        return;
      }

      // Show the install prompt
      deferredPrompt.prompt();

      // Wait for the user's response
      const { outcome } = await deferredPrompt.userChoice;
      console.log('[PWA] User choice:', outcome);

      if (outcome === 'accepted') {
        console.log('[PWA] User accepted the install prompt');
        installButton.style.display = 'none';
      }

      // Clear the deferred prompt
      deferredPrompt = null;
    });
  }
});

// Listen for successful installation
window.addEventListener('appinstalled', (e) => {
  console.log('[PWA] App installed successfully');
  isInstalled = true;
  
  const installButton = document.getElementById('pwa-install-btn');
  if (installButton) {
    installButton.style.display = 'none';
  }

  // Show success message
  showInstallSuccessMessage();
});

// Show success message after installation
function showInstallSuccessMessage() {
  // Create toast notification
  const toast = document.createElement('div');
  toast.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg z-50 animate-slide-up';
  toast.innerHTML = `
    <div class="flex items-center gap-3">
      <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
      </svg>
      <div>
        <div class="font-semibold">Aplikacja zainstalowana!</div>
        <div class="text-sm opacity-90">Możesz teraz używać Oazy offline</div>
      </div>
    </div>
  `;
  
  document.body.appendChild(toast);
  
  // Remove toast after 5 seconds
  setTimeout(() => {
    toast.classList.add('animate-fade-out');
    setTimeout(() => toast.remove(), 300);
  }, 5000);
}

// Request notification permission
async function requestNotificationPermission() {
  if (!('Notification' in window)) {
    console.log('[PWA] Notifications not supported');
    return false;
  }

  if (Notification.permission === 'granted') {
    console.log('[PWA] Notification permission already granted');
    return true;
  }

  if (Notification.permission !== 'denied') {
    const permission = await Notification.requestPermission();
    console.log('[PWA] Notification permission:', permission);
    return permission === 'granted';
  }

  return false;
}

// Subscribe to push notifications
async function subscribeToPushNotifications() {
  if (!('serviceWorker' in navigator) || !('PushManager' in window)) {
    console.log('[PWA] Push notifications not supported');
    return;
  }

  try {
    const registration = await navigator.serviceWorker.ready;
    
    // Check if already subscribed
    const existingSubscription = await registration.pushManager.getSubscription();
    if (existingSubscription) {
      console.log('[PWA] Already subscribed to push notifications');
      return existingSubscription;
    }

    // Request permission
    const permissionGranted = await requestNotificationPermission();
    if (!permissionGranted) {
      console.log('[PWA] Notification permission denied');
      return null;
    }

    // Subscribe to push notifications
    const subscription = await registration.pushManager.subscribe({
      userVisibleOnly: true,
      applicationServerKey: urlBase64ToUint8Array(
        'YOUR_VAPID_PUBLIC_KEY' // Replace with actual VAPID key
      )
    });

    console.log('[PWA] Subscribed to push notifications:', subscription);
    
    // Send subscription to server
    await fetch('/api/v1/push/subscribe', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${localStorage.getItem('auth_token')}`
      },
      body: JSON.stringify(subscription)
    });

    return subscription;
  } catch (error) {
    console.error('[PWA] Failed to subscribe to push notifications:', error);
    return null;
  }
}

// Helper function to convert VAPID key
function urlBase64ToUint8Array(base64String) {
  const padding = '='.repeat((4 - base64String.length % 4) % 4);
  const base64 = (base64String + padding)
    .replace(/\-/g, '+')
    .replace(/_/g, '/');

  const rawData = window.atob(base64);
  const outputArray = new Uint8Array(rawData.length);

  for (let i = 0; i < rawData.length; ++i) {
    outputArray[i] = rawData.charCodeAt(i);
  }
  return outputArray;
}

// Check for updates
if ('serviceWorker' in navigator) {
  navigator.serviceWorker.addEventListener('controllerchange', () => {
    console.log('[PWA] New service worker activated');
    
    // Show update notification
    const updateNotification = document.createElement('div');
    updateNotification.className = 'fixed top-4 right-4 bg-blue-500 text-white px-6 py-4 rounded-lg shadow-lg z-50 animate-slide-down';
    updateNotification.innerHTML = `
      <div class="flex items-center gap-3">
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
        </svg>
        <div>
          <div class="font-semibold">Dostępna aktualizacja!</div>
          <button onclick="window.location.reload()" class="text-sm underline opacity-90 hover:opacity-100">
            Odśwież teraz
          </button>
        </div>
      </div>
    `;
    
    document.body.appendChild(updateNotification);
  });
}

// Export functions for use in other scripts
window.PWA = {
  requestNotificationPermission,
  subscribeToPushNotifications,
  isInstalled: () => isInstalled
};
