<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Szczegóły placówki') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Session Status -->
            @if(session('success'))
                <div class="mb-4 px-4 py-2 bg-green-100 border border-green-400 text-green-700 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    {{-- Nazwa placówki i przyciski akcji --}}
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $facility->name }}</h3>
                        
                        @auth
                        <div class="flex items-center gap-x-4">
                            <a href="{{ route('facilities.edit', $facility->id) }}" class="rounded-md bg-yellow-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-yellow-400">
                                Edytuj
                            </a>
                            <form action="{{ route('facilities.destroy', $facility) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć tę placówkę?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500">
                                    Usuń
                                </button>
                            </form>
                        </div>
                        @endauth
                    </div>
                    
                    {{-- Mapa lokalizacji --}}
                    @if($facility->latitude && $facility->longitude)
                    <div class="mt-4">
                        <div id="map" class="h-64 rounded-lg shadow-md"></div>
                    </div>
                    @endif

                    {{-- Statystyki ocen --}}
                    @if($facility->reviews->count() > 0)
                    <div class="mt-6 bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <div class="flex items-center gap-4">
                            <div class="text-center">
                                <div class="text-4xl font-bold text-gray-900 dark:text-gray-100">
                                    {{ number_format($facility->reviews->avg('rating'), 1) }}
                                </div>
                                <div class="flex items-center justify-center mt-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-5 h-5 {{ $i <= round($facility->reviews->avg('rating')) ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @endfor
                                </div>
                                <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    {{ $facility->reviews->count() }} {{ $facility->reviews->count() === 1 ? 'ocena' : 'ocen' }}
                                </div>
                            </div>
                            <div class="flex-1">
                                @for($rating = 5; $rating >= 1; $rating--)
                                    @php
                                        $count = $facility->reviews->where('rating', $rating)->count();
                                        $percentage = $facility->reviews->count() > 0 ? ($count / $facility->reviews->count()) * 100 : 0;
                                    @endphp
                                    <div class="flex items-center gap-2 text-sm">
                                        <span class="text-gray-600 dark:text-gray-300 w-12">{{ $rating }} ★</span>
                                        <div class="flex-1 bg-gray-200 dark:bg-gray-600 rounded-full h-2">
                                            <div class="bg-yellow-400 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                                        </div>
                                        <span class="text-gray-500 dark:text-gray-400 w-8">{{ $count }}</span>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- Sekcja ze szczegółami --}}
                    <div class="mt-6 border-t border-gray-200 dark:border-gray-700">
                        <dl class="divide-y divide-gray-200 dark:divide-gray-700">
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                    Adres
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200 sm:mt-0 sm:col-span-2">
                                    {{ $facility->address }}
                                </dd>
                            </div>
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                    Telefon
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200 sm:mt-0 sm:col-span-2">
                                    {{ $facility->phone ?? 'Brak numeru telefonu.' }}
                                </dd>
                            </div>
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                    Email
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200 sm:mt-0 sm:col-span-2">
                                    <a href="mailto:{{ $facility->email }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200">{{ $facility->email ?? 'Brak adresu email.' }}</a>
                                </dd>
                            </div>
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                    Strona internetowa
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200 sm:mt-0 sm:col-span-2">
                                     <a href="{{ $facility->website ?? '#' }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200">{{ $facility->website ?? 'Brak strony internetowej.' }}</a>
                                </dd>
                            </div>
                            @if($facility->description)
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                    Opis
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-gray-200 sm:mt-0 sm:col-span-2">
                                    {{ $facility->description }}
                                </dd>
                            </div>
                            @endif
                        </dl>
                    </div>

                    {{-- Przycisk powrotu --}}
                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700 flex items-center justify-start">
                        <a href="{{ route('facilities.index') }}" class="rounded-md bg-gray-200 px-3 py-2 text-sm font-semibold text-gray-800 shadow-sm hover:bg-gray-300">
                            &laquo; Powrót do listy
                        </a>
                    </div>
                </div>
            </div>

            {{-- Sekcja recenzji --}}
            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">
                        Opinie użytkowników
                    </h3>

                    @auth
                    {{-- Formularz dodawania recenzji --}}
                    <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-3">Dodaj swoją opinię</h4>
                        <form action="{{ route('reviews.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="facility_id" value="{{ $facility->id }}">
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Ocena
                                </label>
                                <div class="flex items-center gap-1" id="star-rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        <label class="cursor-pointer star-label" data-rating="{{ $i }}">
                                            <input type="radio" name="rating" value="{{ $i }}" required class="hidden">
                                            <svg class="w-8 h-8 text-gray-300 transition-colors duration-150 star-icon" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        </label>
                                    @endfor
                                </div>
                                @error('rating')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="comment" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Komentarz (opcjonalnie)
                                </label>
                                <textarea 
                                    id="comment" 
                                    name="comment" 
                                    rows="3" 
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:text-gray-100"
                                    placeholder="Podziel się swoją opinią..."
                                >{{ old('comment') }}</textarea>
                                @error('comment')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
                                Dodaj opinię
                            </button>
                        </form>
                    </div>
                    @else
                    <div class="mb-6 p-4 bg-blue-50 dark:bg-blue-900 rounded-lg">
                        <p class="text-sm text-blue-800 dark:text-blue-200">
                            <a href="{{ route('login') }}" class="font-medium underline">Zaloguj się</a>, aby dodać opinię.
                        </p>
                    </div>
                    @endauth

                    {{-- Lista recenzji --}}
                    @if($facility->reviews->count() > 0)
                        <div class="space-y-4">
                            @foreach($facility->reviews->sortByDesc('created_at') as $review)
                                <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-3 mb-2">
                                                <span class="font-medium text-gray-900 dark:text-gray-100">
                                                    {{ $review->user->name }}
                                                </span>
                                                <div class="flex items-center">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                        </svg>
                                                    @endfor
                                                </div>
                                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $review->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                            @if($review->comment)
                                                <p class="text-gray-700 dark:text-gray-300 text-sm">
                                                    {{ $review->comment }}
                                                </p>
                                            @endif
                                        </div>
                                        @auth
                                            @if(auth()->id() === $review->user_id || auth()->user()->isAdmin())
                                                <form action="{{ route('reviews.destroy', $review) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć tę opinię?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 text-sm">
                                                        Usuń
                                                    </button>
                                                </form>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400 text-center py-8">
                            Brak opinii. Bądź pierwszy, który oceni tę placówkę!
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if($facility->latitude && $facility->longitude)
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inicjalizacja mapy
            const map = L.map('map').setView([{{ $facility->latitude }}, {{ $facility->longitude }}], 15);
            
            // Dodanie warstwy OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            
            // Dodanie markera
            L.marker([{{ $facility->latitude }}, {{ $facility->longitude }}])
                .addTo(map)
                .bindPopup('<b>{{ $facility->name }}</b><br>{{ $facility->address }}<br>{{ $facility->city }}')
                .openPopup();
        });
    </script>
    @endif

    {{-- JavaScript dla gwiazdek oceny --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const starRating = document.getElementById('star-rating');
            if (!starRating) return;

            const labels = starRating.querySelectorAll('.star-label');
            const stars = starRating.querySelectorAll('.star-icon');
            let selectedRating = 0;

            // Funkcja do podświetlania gwiazdek
            function highlightStars(rating) {
                stars.forEach((star, index) => {
                    if (index < rating) {
                        star.classList.remove('text-gray-300');
                        star.classList.add('text-yellow-400');
                    } else {
                        star.classList.remove('text-yellow-400');
                        star.classList.add('text-gray-300');
                    }
                });
            }

            // Hover effect
            labels.forEach((label, index) => {
                label.addEventListener('mouseenter', () => {
                    highlightStars(index + 1);
                });

                // Kliknięcie w gwiazdkę
                label.addEventListener('click', () => {
                    selectedRating = index + 1;
                    label.querySelector('input').checked = true;
                    highlightStars(selectedRating);
                });
            });

            // Przywróć wybraną ocenę po zjechaniu myszką
            starRating.addEventListener('mouseleave', () => {
                highlightStars(selectedRating);
            });
        });
    </script></x-app-layout>