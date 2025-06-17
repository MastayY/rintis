<tr {{ $attributes->merge(['class' => 'transition duration-200 border-b dark:bg-zinc-600 dark:border-zinc-500 last:border-b-0 hover:text-zinc-800 dark:hover:text-white dark:hover:bg-zinc-600/[90%] hover:bg-zinc-600/[3%]']) }}>
    {{ $slot }}
</tr>
