<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Poradnik wiedzy') }}
            </h2>
            @auth
                <a href="{{ route('articles.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                    {{ __('Dodaj artykuł') }}
                </a>
            @endauth
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

    @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">

    <div class="mb-6">
        <form action="{{ route('articles.index') }}" method="GET" class="flex gap-2">
            <input 
                type="text" 
                name="search" 
                value="{{ $search ?? '' }}" 
                placeholder="Szukaj artykułów..."
                class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            >
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-200">
                Szukaj
            </button>
            @if($search)
                <a href="{{ route('articles.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-6 rounded-lg transition duration-200">
                    Wyczyść
                </a>
            @endif
        </form>
    </div>

    <div class="space-y-4">
        @forelse ($articles as $article)
            <div class="bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg p-6 hover:shadow-lg transition duration-200">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <h2 class="text-xl font-semibold mb-2">
                            <a href="{{ route('articles.show', $article->id) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">
                                {{ $article->title }}
                            </a>
                        </h2>
                        <p class="text-gray-600 dark:text-gray-300 mb-2">{{ Str::limit(strip_tags($article->content), 200) }}</p>
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            <span>Autor: {{ $article->user->name }}</span>
                            <span class="mx-2">•</span>
                            <span>{{ $article->published_at ? $article->published_at->format('d.m.Y') : 'Nieopublikowany' }}</span>
                        </div>
                    </div>
                    @if(auth()->check() && (auth()->id() === $article->user_id || auth()->user()->isAdmin()))
                        <div class="flex gap-2 ml-4">
                            <a href="{{ route('articles.edit', $article->id) }}" class="text-blue-600 hover:text-blue-800">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć ten artykuł?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg p-8 text-center">
                <p class="text-gray-600 dark:text-gray-300">{{ $search ? 'Nie znaleziono artykułów.' : 'Brak artykułów. Bądź pierwszym, który doda artykuł!' }}</p>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $articles->links() }}
    </div>
        </div>
    </div>
</x-app-layout>
