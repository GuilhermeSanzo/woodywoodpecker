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

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('uploads/woody_woodpecker_logo.png') }}" type="image/png">
        <link rel="icon" href="{{ asset('uploads/woody_woodpecker_logo.png') }}" type="image/png" sizes="any">
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 flex flex-col">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-grow">
                {{ $slot }}
            </main>

            <footer class="bg-gray-800 text-white mt-20 py-12 text-center">
                <div class="max-w-7xl mx-auto px-4">
                    <p class="text-gray-400 mb-2">&copy; {{ date('Y') }} Woody Woodpecker. All rights reserved.</p>
                    <p class="text-zinc-500 text-sm">
                        Developed by Guilherme Souza.
                        <a href="https://guilhermesanzo.me" class="hover:text-zinc-300 transition-colors ml-1">Return to Hub</a>
                    </p>
                </div>
            </footer>
        </div>
    </body>
</html>
