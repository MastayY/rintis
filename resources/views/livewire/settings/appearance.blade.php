<div class="flex flex-col items-start">
    <x-settings.layout>
        <x-slot name="heading">{{ __('settings.appearance') }}</x-slot>
        <x-slot name="subheading">{{ __('settings.appearance_subheading') }}</x-slot>
        <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
            <flux:radio value="light" icon="sun">{{ __('settings.light') }}</flux:radio>
            <flux:radio value="dark" icon="moon">{{ __('settings.dark') }}</flux:radio>
            <flux:radio value="system" icon="computer-desktop">{{ __('settings.system') }}</flux:radio>
        </flux:radio.group>
    </x-settings.layout>
</div>
