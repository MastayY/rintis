@props(['comment'])

<div x-data="{ showReplies: true, showReplyBox: false }" class="pl-3 border-l border-gray-300 mt-4">
    <div class="flex items-start space-x-3">
        <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}" class="w-10 h-10 rounded-full" alt="Avatar">
        
        <div class="flex-1">
            <div class="bg-gray-100 p-3 rounded-xl">
                <div class="text-sm font-semibold text-gray-800">{{ $comment->user->name }}</div>
                <p class="text-gray-700">{{ $comment->content }}</p>
                <div class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</div>
            </div>

            {{-- Tombol Balas --}}
            @auth
                <button @click="showReplyBox = !showReplyBox" class="text-xs text-blue-500 mt-2 cursor-pointer">
                    <span x-show="!showReplyBox">Balas</span>
                    <span x-show="showReplyBox">Tutup</span>
                </button>

                {{-- Form Balas --}}
                <div x-show="showReplyBox" x-transition class="mt-2 flex gap-1 flex-nowrap">
                    <input wire:model.defer="replyContent.{{ $comment->id }}" class="w-full p-2 border rounded-md text-sm mt-1" placeholder="Tulis balasan..."></input>
                    <button wire:click="addReply('{{ $comment->id }}')" class="mt-1 px-3 py-1 text-sm bg-blue-500 text-white rounded-md">Kirim</button>
                </div>
            @endauth

            {{-- Tombol Collapse/Expand Balasan --}}
            @if ($comment->replies->count())
                <button @click="showReplies = !showReplies" class="text-xs text-blue-500 mt-2 cursor-pointer">
                    <span x-show="!showReplies">Lihat {{ $comment->replies->count() }} balasan</span>
                    <span x-show="showReplies">Sembunyikan balasan</span>
                </button>

                {{-- List Balasan --}}
                <div x-show="showReplies" x-transition class="mt-3 space-y-2">
                    @foreach ($comment->replies as $reply)
                        <x-comment :comment="$reply" />
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
