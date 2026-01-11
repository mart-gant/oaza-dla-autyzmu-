<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Messages') }}
            </h2>
            <a href="{{ route('messages.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                New Message
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($unreadCount > 0)
                        <div class="mb-4 p-3 bg-blue-50 border border-blue-200 text-blue-700 rounded">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            You have {{ $unreadCount }} unread {{ $unreadCount === 1 ? 'message' : 'messages' }}
                        </div>
                    @endif

                    @forelse($conversations as $conversation)
                        @php
                            $otherUser = $conversation->getOtherUser(auth()->id());
                            $lastMessage = $conversation->messages->first();
                            $unreadInConversation = $conversation->messages
                                ->where('receiver_id', auth()->id())
                                ->whereNull('read_at')
                                ->count();
                        @endphp

                        <a href="{{ route('messages.show', $conversation) }}" 
                           class="block mb-3 p-4 border rounded-lg hover:bg-gray-50 transition {{ $unreadInConversation > 0 ? 'border-blue-400 bg-blue-50' : 'border-gray-200' }}">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-semibold">
                                            {{ strtoupper(substr($otherUser->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <h3 class="font-semibold text-gray-900">{{ $otherUser->name }}</h3>
                                            <p class="text-xs text-gray-500">
                                                {{ $conversation->last_message_at ? $conversation->last_message_at->diffForHumans() : 'No messages yet' }}
                                            </p>
                                        </div>
                                    </div>
                                    
                                    @if($lastMessage)
                                        <p class="text-sm text-gray-600 line-clamp-2 ml-13">
                                            <span class="font-medium">
                                                {{ $lastMessage->sender_id === auth()->id() ? 'You' : $otherUser->name }}:
                                            </span>
                                            {{ Str::limit($lastMessage->content, 100) }}
                                        </p>
                                    @endif
                                </div>

                                @if($unreadInConversation > 0)
                                    <span class="inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-blue-600 rounded-full">
                                        {{ $unreadInConversation }}
                                    </span>
                                @endif
                            </div>
                        </a>
                    @empty
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No conversations</h3>
                            <p class="mt-1 text-sm text-gray-500">Start a new conversation to get started.</p>
                            <div class="mt-6">
                                <a href="{{ route('messages.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                    New Message
                                </a>
                            </div>
                        </div>
                    @endforelse

                    @if($conversations->hasPages())
                        <div class="mt-6">
                            {{ $conversations->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
