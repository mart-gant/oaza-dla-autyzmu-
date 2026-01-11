<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Moje wizyty') }}
            </h2>
            <a href="{{ route('visits.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition duration-200">
                + Dodaj wizytę
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg shadow-md">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-semibold">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @forelse ($visits as $visit)
                        <div class="mb-4 p-6 border border-gray-200 dark:border-gray-700 rounded-lg hover:shadow-md transition duration-200">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-3">
                                        <span class="px-3 py-1 text-sm font-semibold rounded-full
                                            @if($visit->status === 'scheduled') bg-blue-100 text-blue-800 
                                            @elseif($visit->status === 'completed') bg-green-100 text-green-800
                                            @else bg-red-100 text-red-800 
                                            @endif">
                                            @if($visit->status === 'scheduled') Zaplanowana
                                            @elseif($visit->status === 'completed') Zakończona
                                            @else Anulowana
                                            @endif
                                        </span>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $visit->visit_date->format('d.m.Y H:i') }}
                                        </span>
                                    </div>
                                    
                                    <div class="space-y-2">
                                        @if($visit->specialist)
                                            <div class="flex items-center text-gray-700 dark:text-gray-300">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                                <span><strong>Specjalista:</strong> {{ $visit->specialist->name }}</span>
                                            </div>
                                        @endif
                                        
                                        @if($visit->facility)
                                            <div class="flex items-center text-gray-700 dark:text-gray-300">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                </svg>
                                                <span><strong>Placówka:</strong> {{ $visit->facility->name }}</span>
                                            </div>
                                        @endif
                                        
                                        @if($visit->notes)
                                            <div class="mt-3 p-3 bg-gray-50 dark:bg-gray-700 rounded">
                                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $visit->notes }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="flex gap-2 ml-4">
                                    <a href="{{ route('visits.edit', $visit->id) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('visits.destroy', $visit->id) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć tę wizytę?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">Brak wizyt</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Twoja lista wizyt jest pusta.</p>
                            <div class="mt-6">
                                <a href="{{ route('visits.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Dodaj pierwszą wizytę
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
