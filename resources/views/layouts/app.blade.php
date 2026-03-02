<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-50">
            {{-- Sidebar --}}
            @auth
                @include('layouts.sidebar')
            @endauth

            {{-- Mobile top bar --}}
            @auth
            <div class="lg:hidden sticky top-0 z-10 bg-white border-b border-gray-100 h-14 flex items-center justify-between px-4" x-data>
                <a href="{{ route('colocation.index') }}" class="flex items-center gap-2">
                    <div class="flex items-center gap-2">
                        <x-application-logo class="h-9 w-auto" />
                        <span class="text-xl font-bold text-gray-900 tracking-tight">
                            Easy<span class="text-blue-600">Coloc</span>
                        </span>
                    </div>
                </a>
                <button @click="$dispatch('toggle-sidebar')" class="w-9 h-9 rounded-lg hover:bg-gray-100 flex items-center justify-center text-gray-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
            @endauth

            {{-- Main Content --}}
            <div class="lg:pl-64">
                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-white border-b border-gray-100">
                        <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="px-4 sm:px-6 lg:px-0">
                    {{ $slot }}
                </main>
            </div>
        </div>

        {{-- Toast notifications --}}
        <x-toast />
    </body>
</html>
