@php
$recovery = session('recovery');
@endphp

<x-guest-layout>
    <div class="text-center mb-6">
        <div class="mx-auto w-20 h-20 bg-gradient-to-br from-blue-100 to-purple-100 rounded-full flex items-center justify-center mb-4">
            <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
        </div>
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2">
            {{ __($recovery ? 'Recovery Code' : 'Two Factor Authentication') }}
        </h2>
        <p class="text-sm text-gray-600 dark:text-gray-400">
            {{ __($recovery ? 'Please confirm access to your account by entering one of your emergency recovery codes.' : 'Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
        </p>
    </div>

    <form method="POST" action="{{ route('two-factor.login') }}">
        @csrf

        @if ($recovery)
            <!-- Recovery Code -->
            <div class="mb-4">
                <label for="recovery_code" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('Recovery Code') }}
                </label>
                <input 
                    id="recovery_code" 
                    type="text" 
                    name="recovery_code" 
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" 
                    autocomplete="one-time-code"
                    autofocus
                    required
                >
                @error('recovery_code')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
        @else
            <!-- 2FA Code -->
            <div class="mb-4">
                <label for="code" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    {{ __('Authentication Code') }}
                </label>
                <input 
                    id="code" 
                    type="text" 
                    name="code" 
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-center text-2xl tracking-widest" 
                    inputmode="numeric"
                    autocomplete="one-time-code"
                    autofocus
                    required
                    maxlength="6"
                    pattern="[0-9]{6}"
                    placeholder="000000"
                >
                @error('code')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
        @endif

        <div class="flex flex-col gap-3 mt-6">
            <button type="submit" class="w-full px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg font-medium hover:shadow-lg hover:scale-105 transition-all">
                {{ __('Verify') }}
            </button>

            <button 
                type="button"
                onclick="window.location='{{ route($recovery ? 'two-factor.login' : 'two-factor.login') }}?recovery={{ $recovery ? '0' : '1' }}'"
                class="w-full px-6 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors text-sm"
            >
                {{ __($recovery ? 'Use an authentication code' : 'Use a recovery code') }}
            </button>
        </div>
    </form>

    <!-- Help Box -->
    <div class="mt-6 p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
        <div class="flex items-start">
            <svg class="w-5 h-5 text-blue-500 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
            <div class="text-xs text-blue-700 dark:text-blue-300">
                <p class="font-medium mb-1">💡 {{ __('Need help?') }}</p>
                <p>{{ __($recovery ? 'Recovery codes are one-time use codes that were provided when you enabled two-factor authentication.' : 'Open your authenticator app (Google Authenticator, Authy, etc.) and enter the 6-digit code.') }}</p>
            </div>
        </div>
    </div>
</x-guest-layout>

<script>
// Auto-submit when 6 digits entered
document.getElementById('code')?.addEventListener('input', function(e) {
    if (e.target.value.length === 6) {
        e.target.closest('form').submit();
    }
});
</script>
