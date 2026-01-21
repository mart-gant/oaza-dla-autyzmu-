<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('O projekcie') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    {{-- Sekcja o autorze --}}
                    <div class="mb-8">
                        <h3 class="text-2xl font-bold mb-4">Kim jestem?</h3>
                        <div class="prose dark:prose-invert max-w-none">
                            <p class="text-lg mb-4">
                                Cześć! Jestem twórcą platformy Oaza dla Autyzmu. 
                            </p>
                            <p class="mb-4">
                                Ta platforma powstała z potrzeby stworzenia miejsca, gdzie rodzice i opiekunowie dzieci ze spektrum autyzmu 
                                mogą znaleźć sprawdzone informacje o placówkach terapeutycznych, wymienić się doświadczeniami oraz 
                                wzajemnie się wspierać.
                            </p>
                        </div>
                    </div>

                    {{-- Misja projektu --}}
                    <div class="mb-8 bg-blue-50 dark:bg-blue-900/20 p-6 rounded-lg">
                        <h3 class="text-2xl font-bold mb-4">Misja projektu</h3>
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-blue-600 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Gromadzenie zweryfikowanych informacji o placówkach wspierających osoby z autyzmem</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-blue-600 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Tworzenie przestrzeni do wymiany doświadczeń między rodzicami i opiekunami</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-blue-600 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Udostępnianie wartościowych artykułów i materiałów edukacyjnych</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-blue-600 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Budowanie społeczności wsparcia dla rodzin dzieci ze spektrum autyzmu</span>
                            </li>
                        </ul>
                    </div>

                    {{-- Źródła danych --}}
                    <div class="mb-8">
                        <h3 class="text-2xl font-bold mb-4">Źródła informacji o placówkach</h3>
                        <p class="mb-4">
                            Informacje o placówkach pochodzą z zaufanych źródeł:
                        </p>
                        <ul class="space-y-2 ml-6 list-disc">
                            <li>
                                <strong>Lista Idy Tyminy</strong> - sprawdzone placówki rekomendowane przez doświadczoną 
                                specjalistkę z wieloletnim doświadczeniem w terapii osób z autyzmem
                            </li>
                            <li>
                                <strong>Certyfikaty Fundacji Dziewczyny w Spektrum</strong> - placówki, które otrzymały 
                                certyfikat za wysoką jakość wsparcia dla osób z autyzmem
                            </li>
                            <li>
                                <strong>Rekomendacje użytkowników</strong> - opinie i oceny od rodziców i opiekunów, 
                                którzy korzystali z usług placówek
                            </li>
                        </ul>
                    </div>

                    {{-- System weryfikacji --}}
                    <div class="mb-8 bg-green-50 dark:bg-green-900/20 p-6 rounded-lg">
                        <h3 class="text-2xl font-bold mb-4">System weryfikacji</h3>
                        <p class="mb-4">
                            Każda placówka w bazie danych jest oznaczona jednym z następujących statusów:
                        </p>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 mr-3">
                                    ✓ Certyfikowana
                                </span>
                                <span>Placówka z certyfikatem jakości lub wiarygodnym źródłem rekomendacji</span>
                            </div>
                            <div class="flex items-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mr-3">
                                    ✓ Zweryfikowana
                                </span>
                                <span>Placówka zweryfikowana przez administratora na podstawie dostępnych informacji</span>
                            </div>
                            <div class="flex items-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 mr-3">
                                    ⚠ Zgłoszono problem
                                </span>
                                <span>Placówka, w której użytkownicy zgłosili problemy z jakością usług</span>
                            </div>
                            <div class="flex items-center">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 mr-3">
                                    Niezweryfikowana
                                </span>
                                <span>Placówka oczekująca na weryfikację</span>
                            </div>
                        </div>
                    </div>

                    {{-- Sekcja kontakt --}}
                    <div class="mb-8">
                        <h3 class="text-2xl font-bold mb-4">Skontaktuj się ze mną</h3>
                        <p class="mb-4">
                            Masz pytania, sugestie lub chcesz zgłosić problem? Skorzystaj z formularza kontaktowego:
                        </p>
                        <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 active:bg-blue-700 transition ease-in-out duration-150">
                            Formularz kontaktowy
                        </a>
                    </div>

                    {{-- Jak możesz pomóc --}}
                    <div class="bg-purple-50 dark:bg-purple-900/20 p-6 rounded-lg">
                        <h3 class="text-2xl font-bold mb-4">Jak możesz pomóc?</h3>
                        <ul class="space-y-2 ml-6 list-disc">
                            <li>Podziel się swoimi doświadczeniami na forum</li>
                            <li>Oceń placówki, z których korzystałeś</li>
                            <li>Dodaj informację o placówce, której nie ma w bazie</li>
                            <li>Zgłoś błędne informacje lub problemy z placówkami</li>
                            <li>Udostępnij stronę innym rodzicom i opiekunom</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
