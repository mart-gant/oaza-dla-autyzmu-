<!-- Cookie Consent Banner -->
<div id="cookieBanner" class="fixed bottom-6 right-6 left-6 md:left-auto md:max-w-md bg-white rounded-2xl shadow-2xl border border-gray-200 z-[60] transform translate-y-[150%] transition-all duration-500 animate-slide-up" style="display: none;">
    <div class="p-6">
        <!-- Header with Icon -->
        <div class="flex items-start gap-3 mb-4">
            <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full flex items-center justify-center text-2xl">
                🍪
            </div>
            <div class="flex-1">
                <h3 class="text-lg font-bold text-gray-900 mb-1">
                    Szanujemy Twoją prywatność
                </h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Używamy cookies do zapewnienia funkcjonalności strony. Za Twoją zgodą możemy też analizować ruch, aby poprawić Twoje doświadczenia.
                </p>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="flex gap-2 mb-4">
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                ✓ Niezbędne
            </span>
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                Funkcjonalne
            </span>
            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                Analityczne
            </span>
        </div>

        <!-- Buttons -->
        <div class="flex flex-col gap-2">
            <button onclick="acceptAllCookies()" class="w-full px-5 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl font-semibold hover:shadow-lg hover:scale-[1.02] transition-all">
                Akceptuj wszystkie cookies
            </button>
            <div class="flex gap-2">
                <button onclick="rejectOptionalCookies()" class="flex-1 px-4 py-2.5 border border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition-colors text-sm">
                    Tylko niezbędne
                </button>
                <button onclick="manageCookiePreferences()" class="flex-1 px-4 py-2.5 border border-blue-600 text-blue-600 rounded-xl font-medium hover:bg-blue-50 transition-colors text-sm">
                    ⚙️ Dostosuj
                </button>
            </div>
        </div>

        <!-- Link -->
        <a href="/cookies" class="block text-center text-blue-600 hover:underline text-xs font-medium mt-3">
            Czytaj politykę cookies →
        </a>
    </div>
</div>

<!-- Cookie Preferences Modal -->
<div id="cookieModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[70] flex items-center justify-center p-4 opacity-0 transition-opacity duration-300" style="display: none;">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto transform scale-95 transition-transform duration-300">
        <div class="p-8">
            <!-- Header -->
            <div class="flex justify-between items-start mb-6">
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-blue-100 to-purple-100 rounded-xl flex items-center justify-center text-2xl">
                        ⚙️
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-1">Centrum prywatności</h2>
                        <p class="text-gray-600 text-sm">Kontroluj, jak wykorzystujemy cookies</p>
                    </div>
                </div>
                <button onclick="closeCookieModal()" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg p-2 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Cookie Categories -->
            <div class="space-y-3">
                <!-- Necessary Cookies -->
                <div class="border-2 border-green-200 rounded-xl p-5 bg-gradient-to-br from-green-50 to-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-green-100 rounded-full -mr-10 -mt-10 opacity-50"></div>
                    <div class="flex justify-between items-start relative">
                        <div class="flex-1 pr-4">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-xl">🔒</span>
                                <h3 class="font-bold text-gray-900">Niezbędne cookies</h3>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Aktywne
                                </span>
                            </div>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Wymagane do działania strony: logowanie, bezpieczeństwo, sesje. Bez nich strona nie będzie działać poprawnie.
                            </p>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="w-14 h-7 bg-green-500 rounded-full flex items-center justify-end px-1 cursor-not-allowed shadow-inner">
                                <div class="w-5 h-5 bg-white rounded-full shadow"></div>
                            </div>
                        </div>
                    </div>
                    <details class="mt-3">
                        <summary class="text-sm text-green-600 cursor-pointer hover:text-green-700 font-medium">
                            📋 Zobacz szczegóły techniczne
                        </summary>
                        <ul class="mt-2 text-xs text-gray-600 space-y-1 ml-6 list-disc bg-white rounded p-3">
                            <li><code class="bg-gray-100 px-1 py-0.5 rounded">XSRF-TOKEN</code> - ochrona CSRF</li>
                            <li><code class="bg-gray-100 px-1 py-0.5 rounded">laravel_session</code> - sesja użytkownika</li>
                            <li><code class="bg-gray-100 px-1 py-0.5 rounded">cookie_consent</code> - Twoje zgody</li>
                        </ul>
                    </details>
                </div>

                <!-- Functional Cookies -->
                <div class="border-2 border-gray-200 rounded-xl p-5 bg-white hover:border-blue-300 transition-colors">
                    <div class="flex justify-between items-start">
                        <div class="flex-1 pr-4">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-xl">🎨</span>
                                <h3 class="font-bold text-gray-900">Funkcjonalne cookies</h3>
                            </div>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Zapamiętują Twoje wybory: język, motyw, ustawienia widoku. Poprawiają komfort korzystania ze strony.
                            </p>
                        </div>
                        <div class="flex-shrink-0">
                            <button onclick="toggleCookie('functional')" id="toggle-functional" class="w-14 h-7 bg-gray-300 rounded-full flex items-center px-1 transition-all focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 hover:shadow-md">
                                <div class="w-5 h-5 bg-white rounded-full transition-transform shadow"></div>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Analytics Cookies -->
                <div class="border-2 border-gray-200 rounded-xl p-5 bg-white hover:border-blue-300 transition-colors">
                    <div class="flex justify-between items-start">
                        <div class="flex-1 pr-4">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-xl">📊</span>
                                <h3 class="font-bold text-gray-900">Analityczne cookies</h3>
                            </div>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Pomagają zrozumieć, jak korzystasz ze strony (Google Analytics). Wszystkie dane są <strong>całkowicie anonimowe</strong>.
                            </p>
                        </div>
                        <div class="flex-shrink-0">
                            <button onclick="toggleCookie('analytics')" id="toggle-analytics" class="w-14 h-7 bg-gray-300 rounded-full flex items-center px-1 transition-all focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 hover:shadow-md">
                                <div class="w-5 h-5 bg-white rounded-full transition-transform shadow"></div>
                            </button>
                        </div>
                    </div>
                    <details class="mt-3">
                        <summary class="text-sm text-blue-600 cursor-pointer hover:text-blue-700 font-medium">
                            📋 Zobacz szczegóły techniczne
                        </summary>
                        <ul class="mt-2 text-xs text-gray-600 space-y-1 ml-6 list-disc bg-blue-50 rounded p-3">
                            <li>Google Analytics: <code class="bg-white px-1 py-0.5 rounded">_ga</code>, <code class="bg-white px-1 py-0.5 rounded">_gid</code></li>
                            <li>Zbieramy: strony, czas wizyty, urządzenie, lokalizacja (miasto)</li>
                            <li>Nie łączymy z danymi osobowymi</li>
                        </ul>
                    </details>
                </div>

                <!-- Marketing Cookies (Disabled) -->
                <div class="border-2 border-gray-200 rounded-xl p-5 bg-gray-50 opacity-60">
                    <div class="flex justify-between items-start">
                        <div class="flex-1 pr-4">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-xl">🎯</span>
                                <h3 class="font-bold text-gray-900">Marketingowe cookies</h3>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-200 text-gray-600">
                                    Nieaktywne
                                </span>
                            </div>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                Obecnie nie używamy cookies do reklam. Ta opcja jest wyłączona.
                            </p>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="w-14 h-7 bg-gray-300 rounded-full flex items-center px-1 cursor-not-allowed">
                                <div class="w-5 h-5 bg-white rounded-full shadow"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 mt-8 pt-6 border-t-2 border-gray-100">
                <button onclick="rejectOptionalCookies()" class="flex-1 px-6 py-3.5 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 hover:border-gray-400 transition-all">
                    ❌ Tylko niezbędne
                </button>
                <button onclick="savePreferences()" class="flex-1 px-6 py-3.5 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl font-semibold hover:shadow-lg hover:scale-[1.02] transition-all">
                    ✓ Zapisz wybór
                </button>
            </div>

            <!-- Help Text -->
            <div class="mt-4 p-4 bg-blue-50 rounded-xl border border-blue-100">
                <p class="text-xs text-gray-600 text-center leading-relaxed">
                    💡 <strong>Dobra wiadomość:</strong> Możesz zmienić te ustawienia w dowolnym momencie. Link "Ustawienia cookies" znajdziesz na dole każdej strony.<br>
                    <a href="/cookies" class="text-blue-600 hover:underline font-medium">Przeczytaj pełną politykę cookies →</a>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
// Cookie management state
let cookiePreferences = {
    necessary: true,  // Always true
    functional: false,
    analytics: false,
    marketing: false
};

// Check if user has already given consent
function checkCookieConsent() {
    const consent = localStorage.getItem('cookie_consent');
    if (!consent) {
        // Show banner after 1 second
        setTimeout(() => {
            showCookieBanner();
        }, 1000);
    } else {
        // Load saved preferences
        cookiePreferences = JSON.parse(consent);
        applyCookiePreferences();
    }
}

// Show cookie banner
function showCookieBanner() {
    const banner = document.getElementById('cookieBanner');
    banner.style.display = 'block';
    setTimeout(() => {
        banner.style.transform = 'translateY(0)';
    }, 100);
}

// Hide cookie banner
function hideCookieBanner() {
    const banner = document.getElementById('cookieBanner');
    banner.style.transform = 'translateY(100%)';
    setTimeout(() => {
        banner.style.display = 'none';
    }, 500);
}

// Accept all cookies
function acceptAllCookies() {
    cookiePreferences = {
        necessary: true,
        functional: true,
        analytics: true,
        marketing: false
    };
    saveConsentAndApply();
}

// Reject optional cookies
function rejectOptionalCookies() {
    cookiePreferences = {
        necessary: true,
        functional: false,
        analytics: false,
        marketing: false
    };
    saveConsentAndApply();
}

// Open cookie preferences modal
function manageCookiePreferences() {
    hideCookieBanner();
    const modal = document.getElementById('cookieModal');
    modal.style.display = 'flex';
    setTimeout(() => {
        modal.style.opacity = '1';
        modal.querySelector('.bg-white').style.transform = 'scale(1)';
    }, 10);
    document.body.style.overflow = 'hidden';
    
    // Load current preferences into toggles
    updateToggleStates();
}

// Close cookie modal
function closeCookieModal() {
    const modal = document.getElementById('cookieModal');
    modal.style.opacity = '0';
    modal.querySelector('.bg-white').style.transform = 'scale(0.95)';
    setTimeout(() => {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }, 300);
}

// Toggle individual cookie category
function toggleCookie(category) {
    cookiePreferences[category] = !cookiePreferences[category];
    updateToggleStates();
}

// Update toggle button states
function updateToggleStates() {
    const categories = ['functional', 'analytics'];
    categories.forEach(category => {
        const toggle = document.getElementById(`toggle-${category}`);
        if (toggle) {
            const isEnabled = cookiePreferences[category];
            const knob = toggle.querySelector('div');
            
            if (isEnabled) {
                toggle.classList.remove('bg-gray-300');
                toggle.classList.add('bg-gradient-to-r', 'from-blue-500', 'to-purple-500');
                knob.style.transform = 'translateX(28px)';
            } else {
                toggle.classList.remove('bg-gradient-to-r', 'from-blue-500', 'to-purple-500');
                toggle.classList.add('bg-gray-300');
                knob.style.transform = 'translateX(0)';
            }
        }
    });
}

// Save preferences from modal
function savePreferences() {
    saveConsentAndApply();
    closeCookieModal();
}

// Save consent and apply preferences
function saveConsentAndApply() {
    localStorage.setItem('cookie_consent', JSON.stringify(cookiePreferences));
    localStorage.setItem('cookie_consent_date', new Date().toISOString());
    applyCookiePreferences();
    hideCookieBanner();
    closeCookieModal();
    
    // Show confirmation toast
    showToast('✓ Preferencje cookies zapisane!');
}

// Show toast notification
function showToast(message) {
    const toast = document.createElement('div');
    toast.className = 'fixed bottom-6 left-1/2 transform -translate-x-1/2 bg-gray-900 text-white px-6 py-3 rounded-xl shadow-lg z-[80] animate-bounce-in';
    toast.textContent = message;
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translate(-50%, 20px)';
        setTimeout(() => toast.remove(), 300);
    }, 2500);
}

// Apply cookie preferences (load/block scripts)
function applyCookiePreferences() {
    // Analytics
    if (cookiePreferences.analytics) {
        loadGoogleAnalytics();
    } else {
        blockGoogleAnalytics();
    }
    
    // Functional cookies - handled by Laravel session
    if (cookiePreferences.functional) {
        // Enable functional features
        console.log('Functional cookies enabled');
    }
}

// Load Google Analytics
function loadGoogleAnalytics() {
    // Only load if not already loaded
    if (!window.ga) {
        // Example - replace with your GA tracking ID
        // const script = document.createElement('script');
        // script.async = true;
        // script.src = 'https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID';
        // document.head.appendChild(script);
        
        console.log('Google Analytics enabled');
    }
}

// Block Google Analytics
function blockGoogleAnalytics() {
    // Disable GA if it exists
    if (window.ga) {
        window['ga-disable-GA_MEASUREMENT_ID'] = true;
        console.log('Google Analytics disabled');
    }
}

// Make function available globally for cookie settings link
window.showCookieBanner = manageCookiePreferences;

// Initialize on page load
document.addEventListener('DOMContentLoaded', checkCookieConsent);
</script>

<style>
/* Smooth animations for cookie components */
#cookieBanner {
    box-shadow: 0 -10px 40px rgba(0, 0, 0, 0.15);
}

@keyframes slide-up {
    from {
        transform: translateY(150%);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

@keyframes bounce-in {
    0% {
        transform: translate(-50%, 30px);
        opacity: 0;
    }
    50% {
        transform: translate(-50%, -5px);
    }
    100% {
        transform: translate(-50%, 0);
        opacity: 1;
    }
}

.animate-slide-up {
    animation: slide-up 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.animate-bounce-in {
    animation: bounce-in 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    transition: opacity 0.3s, transform 0.3s;
}

/* Smooth toggle transitions */
#toggle-functional div,
#toggle-analytics div {
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

#toggle-functional,
#toggle-analytics {
    transition: all 0.3s ease;
}

/* Modal backdrop blur effect */
#cookieModal {
    transition: opacity 0.3s ease;
}

/* Code tag styling */
code {
    font-family: 'Courier New', monospace;
    font-size: 0.9em;
}
</style>

