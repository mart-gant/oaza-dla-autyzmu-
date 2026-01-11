@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <article class="bg-white rounded-lg shadow-lg p-8">
            <header class="mb-6 border-b pb-4">
                <h1 class="text-4xl font-bold mb-4">{{ $article->title }}</h1>
                <div class="flex items-center justify-between text-sm text-gray-600">
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

            <div class="prose max-w-none">
                {!! nl2br(e($article->content)) !!}
            </div>
        </article>

        <div class="mt-6">
            <a href="{{ route('articles.index') }}" class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-6 rounded-lg transition duration-200">
                ← Powrót do listy artykułów
            </a>
        </div>
    </div>
</div>
@endsection
