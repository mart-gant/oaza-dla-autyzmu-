<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edytuj dane placówki') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Display Errors --}}
                    @if ($errors->any())
                        <div class="mb-4">
                            <div class="font-medium text-red-600">{{ __('Whoops! Something went wrong.') }}</div>

                            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('facilities.update', $facility) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        {{-- Nazwa placówki --}}
                        <div>
                            <x-input-label for="name" :value="__('Nazwa placówki')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $facility->name)" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        {{-- Adres --}}
                        <div>
                            <x-input-label for="address" :value="__('Adres')" />
                            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address', $facility->address)" required />
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>

                        {{-- Miasto --}}
                        <div>
                            <x-input-label for="city" :value="__('Miasto')" />
                            <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city', $facility->city)" required />
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>

                        {{-- Kod pocztowy --}}
                        <div>
                            <x-input-label for="postal_code" :value="__('Kod pocztowy')" />
                            <x-text-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code" :value="old('postal_code', $facility->postal_code)" required placeholder="00-000" />
                            <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
                        </div>

                        {{-- Województwo --}}
                        <div>
                            <x-input-label for="province" :value="__('Województwo')" />
                            <x-text-input id="province" class="block mt-1 w-full" type="text" name="province" :value="old('province', $facility->province)" required />
                            <x-input-error :messages="$errors->get('province')" class="mt-2" />
                        </div>
                        
                        {{-- Numer telefonu --}}
                        <div>
            <x-input-label for="phone" :value="__('Numer telefonu')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone', $facility->phone)" required placeholder="+48 123 456 789" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>
        
        {{-- Email --}}
        <div>
            <x-input-label for="email" :value="__('Adres email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $facility->email)" required placeholder="kontakt@placowka.pl" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        {{-- Strona internetowa --}}
                        <div>
                            <x-input-label for="website" :value="__('Strona internetowa')" />
                            <x-text-input id="website" class="block mt-1 w-full" type="url" name="website" :value="old('website', $facility->website)" placeholder="https://example.com" />
                            <x-input-error :messages="$errors->get('website')" class="mt-2" />
                        </div>

                        {{-- Współrzędne GPS --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="latitude" :value="__('Szerokość geograficzna (Latitude)')" />
                                <x-text-input id="latitude" class="block mt-1 w-full" type="number" step="0.0000001" name="latitude" :value="old('latitude', $facility->latitude)" placeholder="52.2297" />
                                <x-input-error :messages="$errors->get('latitude')" class="mt-2" />
                                <p class="mt-1 text-xs text-gray-500">Opcjonalne - do wyświetlenia mapy</p>
                            </div>
                            <div>
                                <x-input-label for="longitude" :value="__('Długość geograficzna (Longitude)')" />
                                <x-text-input id="longitude" class="block mt-1 w-full" type="number" step="0.0000001" name="longitude" :value="old('longitude', $facility->longitude)" placeholder="21.0122" />
                                <x-input-error :messages="$errors->get('longitude')" class="mt-2" />
                                <p class="mt-1 text-xs text-gray-500">Opcjonalne - do wyświetlenia mapy</p>
                            </div>
                        </div>

                        @if(auth()->user() && auth()->user()->isAdmin())
                        {{-- Sekcja weryfikacji - tylko dla adminów --}}
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-6 mt-6">
                            <h3 class="text-lg font-semibold mb-4 text-gray-900 dark:text-gray-100">Weryfikacja placówki (tylko admin)</h3>
                            
                            {{-- Źródło danych --}}
                            <div class="mb-4">
                                <x-input-label for="source" :value="__('Źródło danych')" />
                                <x-text-input id="source" class="block mt-1 w-full" type="text" name="source" :value="old('source', $facility->source)" placeholder="np. Lista Idy Tyminy, Certyfikat DwS" />
                                <x-input-error :messages="$errors->get('source')" class="mt-2" />
                                <p class="mt-1 text-xs text-gray-500">Podaj źródło, z którego pochodzi informacja o placówce</p>
                            </div>

                            {{-- Status weryfikacji --}}
                            <div class="mb-4">
                                <x-input-label for="verification_status" :value="__('Status weryfikacji')" />
                                <select id="verification_status" name="verification_status" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="unverified" {{ old('verification_status', $facility->verification_status ?? 'unverified') === 'unverified' ? 'selected' : '' }}>Niezweryfikowana</option>
                                    <option value="verified" {{ old('verification_status', $facility->verification_status) === 'verified' ? 'selected' : '' }}>Zweryfikowana</option>
                                    <option value="certified" {{ old('verification_status', $facility->verification_status) === 'certified' ? 'selected' : '' }}>Certyfikowana</option>
                                    <option value="flagged" {{ old('verification_status', $facility->verification_status) === 'flagged' ? 'selected' : '' }}>Zgłoszono problem</option>
                                </select>
                                <x-input-error :messages="$errors->get('verification_status')" class="mt-2" />
                            </div>

                            {{-- Notatki weryfikacji --}}
                            <div>
                                <x-input-label for="verification_notes" :value="__('Notatki weryfikacji')" />
                                <textarea id="verification_notes" name="verification_notes" rows="3" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" placeholder="Dodatkowe informacje o weryfikacji, zgłoszonych problemach itp.">{{ old('verification_notes', $facility->verification_notes) }}</textarea>
                                <x-input-error :messages="$errors->get('verification_notes')" class="mt-2" />
                            </div>
                        </div>
                        @endif

                        {{-- Przyciski akcji --}}
                        <div class="mt-6 flex items-center justify-end gap-x-4">
                            <a href="{{ route('facilities.show', $facility) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-500 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Anuluj') }}
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Zapisz zmiany') }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
