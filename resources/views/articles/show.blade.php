<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Artykuł') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <article class="p-8">
                    <header class="mb-6 border-b border-gray-200 dark:border-gray-700 pb-4">
                        <h1 class="text-4xl font-bold mb-4 text-gray-900 dark:text-gray-100">{{ $article->title }}</h1>
                        <div class="flex items-center justify-between text-sm text-gray-600 dark:text-gray-400">
                            <div class="flex items-center gap-4">
                                <span class="font-semibold">Autor: {{ $article->user->name }}</span>
                                @if($article->published_at)
                                    <span>{{ $article->published_at->format('d.m.Y H:i') }}</span>
                                @endif
                            </div>
                            @if(auth()->check() && (auth()->id() === $article->user_id || auth()->user()->isAdmin()))
                                <div class="flex gap-2">
                                    <a href="{{ route('articles.edit', $article->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white py-1 px-4 rounded transition duration-200">
                                        Edytuj
                                    </a>
                                    <form action="{{ route('articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć ten artykuł?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-1 px-4 rounded transition duration-200">
                                            Usuń
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </header>

                    <div class="prose dark:prose-invert max-w-none text-gray-900 dark:text-gray-100">
                        {!! nl2br(e($article->content)) !!}
                    </div>
                </article>

                <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('articles.index') }}" class="inline-block bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 dark:hover:bg-gray-500 text-gray-800 dark:text-gray-200 font-semibold py-2 px-6 rounded-lg transition duration-200">
                        ← Powrót do listy artykułów
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
