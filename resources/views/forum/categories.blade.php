<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Forum - Kategorie') }}
            </h2>
            @auth
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.forum.categories.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-semibold transition duration-200">
                        Zarządzaj kategoriami
                    </a>
                @endif
            @endauth
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                        {{ __('Przeglądaj kategorie dyskusji') }}
                    </h3>
                    <div class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($categories as $category)
                            <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150 ease-in-out flex justify-between items-center">
                                <a href="{{ route('forum.index', $category) }}" class="flex-1">
                                    <p class="text-lg font-semibold text-blue-600 dark:text-blue-400">{{ $category->name }}</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                        {{ $category->topics->count() }} {{ $category->topics->count() === 1 ? 'temat' : 'tematów' }}
                                    </p>
                                </a>
                                @auth
                                    <a href="{{ route('forum.create') }}?category={{ $category->id }}" class="ml-4 text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-sm font-medium">
                                        + Nowy temat
                                    </a>
                                @endauth
                            </div>
                        @empty
                            <div class="p-4 text-center text-gray-500 dark:text-gray-400">
                                <p>{{ __('Nie znaleziono żadnych kategorii forum.') }}</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
