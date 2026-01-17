<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $event->title }}
            </h2>
            @auth
                @if(auth()->id() === $event->user_id || auth()->user()->role === 'admin')
                    <div class="flex gap-2">
                        <a href="{{ route('events.edit', $event) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            {{ __('Edytuj') }}
                        </a>
                        <form method="POST" action="{{ route('events.destroy', $event) }}" onsubmit="return confirm('Czy na pewno chcesz usunąć to wydarzenie?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                                {{ __('Usuń') }}
                            </button>
                        </form>
                    </div>
                @endif
            @endauth
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Data i czas -->
                    <div class="mb-6">
                        <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase mb-2">
                            Data i czas
                        </h3>
                        <div class="flex items-center text-lg">
                            <svg class="w-5 h-5 mr-2 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>
                                {{ $event->start_date->format('d.m.Y H:i') }}
                                @if($event->end_date)
                                    - {{ $event->end_date->format('d.m.Y H:i') }}
                                @endif
                            </span>
                        </div>
                    </div>

                    <!-- Lokalizacja -->
                    @if($event->location)
                        <div class="mb-6">
                            <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase mb-2">
                                Lokalizacja
                            </h3>
                            <div class="flex items-center text-lg">
                                <svg class="w-5 h-5 mr-2 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $event->location }}
                            </div>
                        </div>
                    @endif

                    <!-- Placówka -->
                    @if($event->facility)
                        <div class="mb-6">
                            <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase mb-2">
                                Placówka
                            </h3>
                            <div class="flex items-center text-lg">
                                <svg class="w-5 h-5 mr-2 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                <a href="{{ route('facilities.show', $event->facility) }}" class="text-blue-600 hover:underline">
                                    {{ $event->facility->name }}
                                </a>
                            </div>
                        </div>
                    @endif

                    <!-- Opis -->
                    @if($event->description)
                        <div class="mb-6">
                            <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase mb-2">
                                Opis
                            </h3>
                            <div class="prose dark:prose-invert max-w-none">
                                {!! nl2br(e($event->description)) !!}
                            </div>
                        </div>
                    @endif

                    <!-- Organizator -->
                    <div class="mb-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase mb-2">
                            Organizator
                        </h3>
                        <div class="text-lg">
                            {{ $event->user->name }}
                        </div>
                    </div>

                    <!-- Widoczność -->
                    <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $event->is_public ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $event->is_public ? 'Publiczne' : 'Prywatne' }}
                        </span>
                    </div>

                    <!-- Powrót -->
                    <div class="mt-6">
                        <a href="{{ route('events.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400">
                            ← Powrót do listy wydarzeń
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
