<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'EasyColoc') }}</title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .font-outfit { font-family: 'Outfit', sans-serif; }
            .font-inter { font-family: 'Inter', sans-serif; }
            
            body { 
                font-family: 'Inter', sans-serif;
                background-color: #f8fafc;
            }

            .mesh-bg {
                background-color: #ffffff;
                background-image: 
                    radial-gradient(at 0% 0%, hsla(232,100%,92%,1) 0, transparent 50%), 
                    radial-gradient(at 100% 0%, hsla(242,100%,92%,1) 0, transparent 50%), 
                    radial-gradient(at 100% 100%, hsla(232,100%,92%,1) 0, transparent 50%), 
                    radial-gradient(at 0% 100%, hsla(242,100%,92%,1) 0, transparent 50%);
            }
        </style>
    </head>
    <body class="antialiased font-inter">
        <div class="min-h-screen flex flex-col items-center justify-center p-6 mesh-bg relative overflow-hidden">
            
            {{-- Background Decorations --}}
            <div class="absolute top-0 left-0 w-full h-full pointer-events-none -z-10">
                <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-indigo-100/50 rounded-full blur-[100px]"></div>
                <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-blue-50/50 rounded-full blur-[100px]"></div>
            </div>

            <div class="w-full sm:max-w-md">
                {{-- Logo Section --}}
                <div class="flex flex-col items-center mb-10">
                    <a href="/" class="group transition-transform duration-300 hover:scale-110">
                        <x-application-logo class="w-16 h-16 fill-current text-indigo-600 drop-shadow-xl" />
                    </a>
                    <h2 class="mt-6 font-outfit text-3xl font-extrabold text-slate-900 tracking-tight">
                        Easy<span class="text-indigo-600">Coloc</span>
                    </h2>
                    <p class="mt-2 text-slate-500 text-sm font-medium">Streamline your collective living</p>
                </div>

                {{-- Content Card --}}
                <div class="relative">
                    <div class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-blue-500 rounded-[2.5rem] blur opacity-10"></div>
                    <div class="relative bg-white/80 backdrop-blur-xl border border-white/20 shadow-2xl shadow-indigo-100/50 rounded-[2rem] p-8 md:p-10">
                        {{ $slot }}
                    </div>
                </div>

                {{-- Footer --}}
                <div class="mt-10 text-center">
                    <p class="text-slate-400 text-xs font-semibold uppercase tracking-widest leading-none">
                        &copy; {{ date('Y') }} EasyColoc &bull; Secure Access
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>
