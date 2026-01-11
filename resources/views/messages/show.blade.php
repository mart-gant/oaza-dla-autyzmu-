<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('messages.index') }}" class="text-gray-600 hover:text-gray-900">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Conversation with {{ $otherUser->name }}
                </h2>
                <p class="text-sm text-gray-500">{{ $otherUser->email }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Messages Container -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 space-y-4 max-h-[600px] overflow-y-auto" id="messages-container">
                    @forelse($messages as $message)
                        @php
                            $isOwn = $message->sender_id === auth()->id();
                        @endphp
                        
                        <div class="flex {{ $isOwn ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-[70%]">
                                <div class="flex items-end gap-2 {{ $isOwn ? 'flex-row-reverse' : 'flex-row' }}">
                                    <!-- Avatar -->
                                    <div class="w-8 h-8 bg-gradient-to-br {{ $isOwn ? 'from-blue-500 to-purple-600' : 'from-green-500 to-teal-600' }} rounded-full flex items-center justify-center text-white text-sm font-semibold flex-shrink-0">
                                        {{ strtoupper(substr($message->sender->name, 0, 1)) }}
                                    </div>
                                    
                                    <!-- Message Bubble -->
                                    <div class="{{ $isOwn ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-900' }} rounded-2xl px-4 py-2">
                                        <p class="text-sm whitespace-pre-wrap break-words">{{ $message->content }}</p>
                                    </div>
                                </div>
                                
                                <!-- Timestamp & Read Status -->
                                <div class="flex items-center gap-2 mt-1 {{ $isOwn ? 'justify-end' : 'justify-start' }} px-10">
                                    <p class="text-xs text-gray-500">
                                        {{ $message->created_at->format('H:i, d M Y') }}
                                    </p>
                                    @if($isOwn && $message->isRead())
                                        <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                                        </svg>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-gray-500">
                            <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            <p>No messages yet. Start the conversation!</p>
                        </div>
                    @endforelse
                </div>

                @if($messages->hasPages())
                    <div class="px-6 pb-4">
                        {{ $messages->links() }}
                    </div>
                @endif
            </div>

            <!-- Message Form -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('messages.store') }}">
                        @csrf
                        <input type="hidden" name="receiver_id" value="{{ $otherUser->id }}">
                        
                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Your Message</label>
                            <textarea 
                                id="content" 
                                name="content" 
                                rows="4" 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                placeholder="Type your message..."
                                required
                            >{{ old('content') }}</textarea>
                            @error('content')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-between items-center">
                            <p class="text-sm text-gray-500">
                                <span id="char-count">0</span> / 5000 characters
                            </p>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                </svg>
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Auto-scroll to bottom on load
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('messages-container');
            if (container) {
                container.scrollTop = container.scrollHeight;
            }

            // Character counter
            const textarea = document.getElementById('content');
            const charCount = document.getElementById('char-count');
            
            if (textarea && charCount) {
                textarea.addEventListener('input', function() {
                    charCount.textContent = this.value.length;
                    if (this.value.length > 5000) {
                        charCount.classList.add('text-red-600');
                    } else {
                        charCount.classList.remove('text-red-600');
                    }
                });
                
                // Initial count
                charCount.textContent = textarea.value.length;
            }
        });
    </script>
    @endpush
</x-app-layout>
