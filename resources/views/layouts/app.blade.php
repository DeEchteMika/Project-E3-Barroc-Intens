<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Barroc Intens') }}</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Display:wght@500;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .brand-title {
            font-family: 'Big Shoulders Display', sans-serif;
            letter-spacing: 1px;
        }
    </style>
</head>

<body class="bg-[#fbfbfb] text-gray-900 antialiased">

<div class="min-h-screen flex flex-col">

    {{-- NAVIGATION --}}
    <nav class="bg-white shadow-md border-b-4 border-[#ffd700]">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <h1 class="brand-title text-3xl text-[#212121]">
                Barroc Intens
            </h1>

            @include('layouts.navigation')
        </div>
    </nav>


    {{-- HEADER --}}
    @isset($header)
        <header class="bg-white border-b-2 border-[#ffd700]/30">
            <div class="max-w-7xl mx-auto py-6 px-6">
                <div class="text-gray-900">{{ $header }}</div>
            </div>
        </header>
    @endisset


    {{-- CONTENT --}}
    <main class="flex-1 bg-[#fbfbfb]">
        <div class="max-w-7xl mx-auto px-6 py-10">
            <div class="bg-white rounded-lg p-8 shadow-sm border border-[#ffd700]/20">
                @yield('content')
            </div>
        </div>
    </main>


    {{-- FOOTER --}}
    <footer class="bg-white text-sm text-gray-600 text-center py-4 border-t-4 border-[#ffd700]">
        © {{ date('Y') }} Barroc Intens
    </footer>

</div>

</body>
</html>
