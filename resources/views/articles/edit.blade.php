@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">Edytuj artykuł</h1>
        
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('articles.update', $article->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    Tytuł artykułu *
                </label>
                <input 
                    type="text" 
                    id="title"
                    name="title" 
                    value="{{ old('title', $article->title) }}" 
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >
            </div>

            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                    Treść artykułu *
                </label>
                <textarea 
                    id="content"
                    name="content" 
                    required
                    rows="15"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >{{ old('content', $article->content) }}</textarea>
            </div>

            <div class="flex items-center">
                <input 
                    type="checkbox" 
                    id="is_published"
                    name="is_published" 
                    value="1"
                    {{ old('is_published', $article->is_published) ? 'checked' : '' }}
                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                >
                <label for="is_published" class="ml-2 block text-sm text-gray-700">
                    Opublikuj artykuł
                </label>
            </div>

            <div class="flex gap-4">
                <button 
                    type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-200"
                >
                    Zapisz zmiany
                </button>
                <a 
                    href="{{ route('articles.show', $article->id) }}" 
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-6 rounded-lg transition duration-200"
                >
                    Anuluj
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
