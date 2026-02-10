<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased" style="background: linear-gradient(135deg, #fbfbfb 0%, #f5f5f5 100%);">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="mb-8">
                <a href="/" class="inline-block p-3 rounded-lg border-2 border-[#ffd700] bg-white hover:bg-[#fffacd] transition-colors">
                    <x-application-logo class="w-16 h-16 fill-current text-[#212121]" />
                </a>
            </div>

            <div class="w-full sm:max-w-md px-6 py-8 bg-white shadow-lg overflow-hidden sm:rounded-xl border border-[#ffd700]/30 relative">
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#ffd700] via-[#ffed4e] to-[#ffd700]"></div>
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
