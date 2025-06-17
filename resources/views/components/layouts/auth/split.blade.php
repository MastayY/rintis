<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen flex flex-col items-center justify-center px-4 bg-gradient">
        {{ $slot }}
        @fluxScripts
    </body>
</html>
