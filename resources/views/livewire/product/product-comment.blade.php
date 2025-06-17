<div x-data="{ showComments: false }" class="max-w-2xl mx-auto">
    {{-- New Comment --}}
    @auth
        <textarea wire:model.defer="content" class="w-full p-3 border rounded-md mb-2" placeholder="Tulis komentar..."></textarea>
        <button wire:click="addComment" class="px-4 py-2 bg-blue-600 text-white rounded-md cursor-pointer">Kirim</button>
    @endauth

    {{-- Toggle Comments --}}
    <div class="mt-4">
        <button @click="showComments = !showComments" class="text-blue-600 text-sm cursor-pointer">
            <template x-if="!showComments">
                <span>Tampilkan {{ count($comments) }} Komentar</span>
            </template>
            <template x-if="showComments">
                <span>Sembunyikan Komentar</span>
            </template>
        </button>
    </div>

    {{-- All Comments (Collapsed/Expanded) --}}
    <div x-show="showComments" x-transition class="my-6 space-y-6">
        @foreach ($comments as $comment)
            <x-comment :comment="$comment" />
        @endforeach
    </div>
</div>
