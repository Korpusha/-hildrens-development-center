<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    @include('layouts.navigation')

    @isset($header)
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    @if (session('success'))
        <div class="bg-green-500 text-white px-6 py-4 shadow-lg mb-4">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2 text-white"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-500 text-white px-6 py-4 shadow-lg mb-4">
            <div class="flex items-center">
                <i class="fas fa-times-circle mr-2 text-white"></i>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <main>
        {{ $slot }}
    </main>
</div>
</body>
</html>
