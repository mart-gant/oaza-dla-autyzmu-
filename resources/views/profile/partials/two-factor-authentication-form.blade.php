<section>
    <header>
        <div class="flex items-center gap-3 mb-2">
            <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-purple-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Two Factor Authentication') }}
                </h2>
            </div>
        </div>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Add additional security to your account using two factor authentication.') }}
        </p>
    </header>

    <div class="mt-6 space-y-6">
        @if (auth()->user()->two_factor_secret)
            <!-- 2FA is Enabled -->
            <div class="p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <p class="text-sm font-medium text-green-700 dark:text-green-300">
                        {{ __('Two factor authentication is enabled.') }}
                    </p>
                </div>
            </div>

            <!-- QR Code Display (if not yet confirmed) -->
            @if (!auth()->user()->two_factor_confirmed_at)
                <div class="p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
                    <p class="text-sm text-blue-700 dark:text-blue-300 mb-4">
                        {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application.') }}
                    </p>

                    <div class="flex justify-center p-4 bg-white dark:bg-gray-800 rounded-lg mb-4">
                        {!! auth()->user()->twoFactorQrCodeSvg() !!}
                    </div>

                    @if (auth()->user()->two_factor_secret)
                        <div class="p-3 bg-gray-100 dark:bg-gray-700 rounded-lg">
                            <p class="text-xs text-gray-600 dark:text-gray-400 mb-1">{{ __('Setup Key') }}:</p>
                            <code class="text-sm font-mono text-gray-900 dark:text-gray-100 break-all">{{ decrypt(auth()->user()->two_factor_secret) }}</code>
                        </div>
                    @endif
                </div>
            @endif

            <div class="flex items-center justify-between p-4 border border-gray-300 dark:border-gray-600 rounded-lg">
                <div class="flex-1">
                    <h3 class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ __('Recovery Codes') }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('Store these codes in a secure place. They can be used to recover access if you lose your device.') }}</p>
                </div>
                <div class="ml-4 flex gap-2">
                    <form method="GET" action="{{ url('/user/two-factor-recovery-codes') }}">
                        @csrf
                        <button type="submit" class="px-4 py-2 text-sm bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                            {{ __('Show Codes') }}
                        </button>
                    </form>
                    <form method="POST" action="{{ url('/user/two-factor-recovery-codes') }}">
                        @csrf
                        <button type="submit" class="px-4 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            {{ __('Regenerate') }}
                        </button>
                    </form>
                </div>
            </div>

            @if (session('recoveryCodes'))
                <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100 mb-3">{{ __('Recovery Codes') }}</h4>
                    <div class="grid grid-cols-2 gap-2 font-mono text-sm">
                        @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes), true) as $code)
                            <div class="p-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded">
                                {{ $code }}
                            </div>
                        @endforeach
                    </div>
                    <p class="mt-3 text-xs text-red-600 dark:text-red-400">
                        ⚠️ {{ __('Save these codes now. You can regenerate them anytime.') }}
                    </p>
                </div>
            @endif

            <form method="POST" action="{{ url('/user/two-factor-authentication') }}">
                @csrf
                @method('DELETE')

                <button type="submit" class="px-6 py-3 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition-colors">
                    {{ __('Disable Two Factor Authentication') }}
                </button>
            </form>

        @else
            <!-- 2FA is Disabled -->
            <div class="p-4 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-yellow-500 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    <div class="text-sm text-yellow-700 dark:text-yellow-300">
                        <p class="font-medium">{{ __('Two factor authentication is not enabled.') }}</p>
                        <p class="mt-1">{{ __('When enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.') }}</p>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ url('/user/two-factor-authentication') }}">
                @csrf

                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-lg font-medium hover:shadow-lg hover:scale-105 transition-all">
                    {{ __('Enable Two Factor Authentication') }}
                </button>
            </form>
        @endif

        <!-- Info Box -->
        <div class="p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-blue-500 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                <div class="text-xs text-blue-700 dark:text-blue-300">
                    <p class="font-medium mb-1">💡 {{ __('What is 2FA?') }}</p>
                    <p>{{ __('Two-factor authentication (2FA) adds an extra layer of security to your account. Even if someone knows your password, they won\'t be able to access your account without the code from your authenticator app.') }}</p>
                    <p class="mt-2">{{ __('Recommended apps: Google Authenticator, Authy, Microsoft Authenticator') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    [x-cloak] { display: none !important; }
</style>
