<form {{ $attributes->merge(['class' => 'space-y-6 border p-4 rounded-lg dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-900/50']) }}>
    {{ $slot }}
</form>
