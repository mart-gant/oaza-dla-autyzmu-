<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Role Selection -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                Kim jesteś? <span class="text-red-500">*</span>
            </label>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Autistic Person Card -->
                <label class="role-card cursor-pointer">
                    <input type="radio" name="role" value="autistic_person" class="peer hidden" {{ old('role') == 'autistic_person' ? 'checked' : '' }} required>
                    <div class="border-2 border-gray-300 dark:border-gray-600 rounded-lg p-4 transition-all hover:border-teal-500 peer-checked:border-teal-600 peer-checked:bg-teal-50 dark:peer-checked:bg-teal-900/20 peer-checked:ring-2 peer-checked:ring-teal-500">
                        <div class="flex flex-col items-center text-center">
                            <svg class="w-12 h-12 mb-3 text-gray-600 dark:text-gray-400 peer-checked:text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <h3 class="font-bold text-gray-900 dark:text-white mb-1">Osoba autystyczna</h3>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Jestem w spektrum autyzmu</p>
                        </div>
                    </div>
                </label>

                <!-- Parent/Guardian Card -->
                <label class="role-card cursor-pointer">
                    <input type="radio" name="role" value="parent" class="peer hidden" {{ old('role', 'parent') == 'parent' ? 'checked' : '' }}>
                    <div class="border-2 border-gray-300 dark:border-gray-600 rounded-lg p-4 transition-all hover:border-blue-500 peer-checked:border-blue-600 peer-checked:bg-blue-50 dark:peer-checked:bg-blue-900/20 peer-checked:ring-2 peer-checked:ring-blue-500">
                        <div class="flex flex-col items-center text-center">
                            <svg class="w-12 h-12 mb-3 text-gray-600 dark:text-gray-400 peer-checked:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <h3 class="font-bold text-gray-900 dark:text-white mb-1">Rodzic / Opiekun</h3>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Szukam wsparcia dla bliskiej osoby</p>
                        </div>
                    </div>
                </label>

                <!-- Therapist Card -->
                <label class="role-card cursor-pointer">
                    <input type="radio" name="role" value="therapist" class="peer hidden" {{ old('role') == 'therapist' ? 'checked' : '' }}>
                    <div class="border-2 border-gray-300 dark:border-gray-600 rounded-lg p-4 transition-all hover:border-purple-500 peer-checked:border-purple-600 peer-checked:bg-purple-50 dark:peer-checked:bg-purple-900/20 peer-checked:ring-2 peer-checked:ring-purple-500">
                        <div class="flex flex-col items-center text-center">
                            <svg class="w-12 h-12 mb-3 text-gray-600 dark:text-gray-400 peer-checked:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <h3 class="font-bold text-gray-900 dark:text-white mb-1">Terapeuta</h3>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Pracuję z osobami ze spektrum autyzmu</p>
                        </div>
                    </div>
                </label>

                <!-- Educator Card -->
                <label class="role-card cursor-pointer">
                    <input type="radio" name="role" value="educator" class="peer hidden" {{ old('role') == 'educator' ? 'checked' : '' }}>
                    <div class="border-2 border-gray-300 dark:border-gray-600 rounded-lg p-4 transition-all hover:border-green-500 peer-checked:border-green-600 peer-checked:bg-green-50 dark:peer-checked:bg-green-900/20 peer-checked:ring-2 peer-checked:ring-green-500">
                        <div class="flex flex-col items-center text-center">
                            <svg class="w-12 h-12 mb-3 text-gray-600 dark:text-gray-400 peer-checked:text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            <h3 class="font-bold text-gray-900 dark:text-white mb-1">Edukator</h3>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Prowadzę edukację lub wspieram rozwój</p>
                        </div>
                    </div>
                </label>
            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" value="Imię i nazwisko" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Adres e-mail" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Hasło" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Minimum 8 znaków</p>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" value="Potwierdź hasło" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Terms Acceptance -->
        <div class="flex items-start">
            <input type="checkbox" id="terms" name="terms" required class="mt-1 rounded border-gray-300 dark:border-gray-600 text-blue-600 focus:ring-blue-500">
            <label for="terms" class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                Akceptuję <a href="/terms" target="_blank" class="text-blue-600 hover:underline">Regulamin</a> oraz <a href="/privacy" target="_blank" class="text-blue-600 hover:underline">Politykę prywatności</a>
            </label>
        </div>

        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4">
            <a class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 underline" href="{{ route('login') }}">
                Masz już konto? Zaloguj się
            </a>

            <x-primary-button class="w-full sm:w-auto justify-center">
                Utwórz konto
            </x-primary-button>
        </div>
    </form>

    <style>
        .role-card input:checked ~ div svg {
            transform: scale(1.1);
            transition: transform 0.2s;
        }
    </style>
</x-guest-layout>
