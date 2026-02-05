<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Tiankii') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main>
                @if (session('success'))
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6" id="alert-success">
                        <div class="bg-green-50 border-l-4 border-green-500 p-4 shadow-sm flex justify-between items-center rounded-r">
                            <div class="flex items-center">
                                <span class="text-green-500 text-xl mr-2">✓</span>
                                <p class="text-green-700 font-bold">{{ session('success') }}</p>
                            </div>
                            <button onclick="document.getElementById('alert-success').style.display='none'" class="text-green-700 font-bold hover:text-green-900">×</button>
                        </div>
                    </div>
                @endif
                
                @if (session('error'))
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 shadow-sm rounded-r">
                            <p class="text-red-700 font-bold">Error</p>
                            <p class="text-red-600 text-sm">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </body>
</html>