<section class="mt-10 space-y-6">
    <div class="relative mb-5">
        <flux:heading>{{ __('settings.delete_account_title') }}</flux:heading>
        <flux:subheading>{{ __('settings.delete_account_subtitle') }}</flux:subheading>
    </div>

    <flux:modal.trigger name="confirm-user-deletion">
        <flux:button variant="danger" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
            {{ __('settings.delete_account_title') }}
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable class="max-w-lg">
        <form wire:submit="deleteUser" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('settings.delete_are_you_sure') }}</flux:heading>

                <flux:subheading>
                    {{ __('settings.delete_are_you_sure_text') }}
                </flux:subheading>
            </div>

            <flux:input wire:model="password" id="password" :label="__('settings.password')" type="password" name="password" />

            <div class="flex justify-end space-x-2">
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('global.cancel') }}</flux:button>
                </flux:modal.close>
                <flux:spacer />
                <flux:button variant="danger" type="submit">{{ __('settings.delete_account_title') }}</flux:button>
            </div>
        </form>
    </flux:modal>
</section>
