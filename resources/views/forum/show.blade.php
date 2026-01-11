<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $topic->title }}
            </h2>
            <div class="flex gap-2">
                @can('update', $topic)
                    <a href="{{ route('forum.edit', $topic) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 text-sm font-medium">
                        Edytuj temat
                    </a>
                @endcan
                @can('delete', $topic)
                    <form action="{{ route('forum.destroy', $topic) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć ten temat?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 text-sm font-medium">
                            Usuń temat
                        </button>
                    </form>
                @endcan
            </div>
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
                    <div class="mb-4 p-6 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <p class="text-base">{{ $topic->posts->first()->body }}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                            <strong>{{ __('Autor:') }}</strong> {{ $topic->user->name }} • 
                            {{ $topic->created_at->format('d.m.Y H:i') }}
                        </p>
                    </div>

                    <div class="mt-6">
                        <h3 class="text-lg font-semibold mb-4">Odpowiedzi</h3>
                        @forelse ($posts->skip(1) as $post)
                            <div class="p-4 mb-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                                <p class="text-base">{{ $post->body }}</p>
                                <div class="flex justify-between items-center mt-3">
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        <strong>{{ __('Autor:') }}</strong> {{ $post->user->name }} • 
                                        {{ $post->created_at->format('d.m.Y H:i') }}
                                    </p>
                                    <div class="flex gap-3">
                                        @can('update', $post)
                                            <a href="{{ route('forum.post.edit', $post) }}" class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400">
                                                {{ __('Edytuj') }}
                                            </a>
                                        @endcan
                                        @can('delete', $post)
                                            <form action="{{ route('forum.post.destroy', $post) }}" method="POST" class="inline" onsubmit="return confirm('Czy na pewno chcesz usunąć tę odpowiedź?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-sm text-red-600 hover:text-red-800 dark:text-red-400">
                                                    {{ __('Usuń') }}
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 dark:text-gray-400">{{ __('Brak odpowiedzi w tym temacie.') }}</p>
                        @endforelse
                    </div>

                    <div class="mt-4">
                        {{ $posts->links() }}
                    </div>

                    @auth
                        <div class="mt-4">
                            <form action="{{ route('forum.post.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="forum_topic_id" value="{{ $topic->id }}">
                                <div>
                                    <x-input-label for="body" :value="__('Odpowiedz')" />
                                    <textarea id="body" name="body" class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('body') }}</textarea>
                                    <x-input-error :messages="$errors->get('body')" class="mt-2" />
                                </div>
                                <div class="flex items-center justify-end mt-4">
                                    <x-primary-button class="ml-3">
                                        {{ __('Odpowiedz') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
