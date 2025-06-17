@props([
    'title' => null,
    'subtitle' => null,
])
<div class="relative mb-6 w-full">
    <div class="flex justify-between items-center @if(empty($subtitle)) mb-4 @endif">
        <div>
            @if(!empty($title))
                <flux:heading size="xl" level="1">{{ $title }}</flux:heading>
            @endif
            @if(!empty($subtitle))
                <flux:subheading size="lg" class="mb-6">{{ $subtitle }}</flux:subheading>
            @endif
        </div>
        <div>
            @if(!empty($buttons))
                <div class="flex gap-2">
                    {{ $buttons }}
                </div>
            @endif
        </div>
    </div>
    <flux:separator variant="subtle" />
</div>
