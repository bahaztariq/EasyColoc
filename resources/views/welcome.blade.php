<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EasyColoc - Streamline Your Collective Living</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .font-outfit { font-family: 'Outfit', sans-serif; }
        .font-inter { font-family: 'Inter', sans-serif; }
        
        body { 
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
        }

        .hero-gradient {
            background: radial-gradient(circle at 18.7% 37.8%, rgb(250, 250, 250) 0%, rgb(225, 234, 238) 90%);
        }

        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .gradient-text {
            background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
    </style>
</head>
<body class="antialiased text-slate-900 overflow-x-hidden">
    {{-- Header/Navigation --}}
    <nav class="fixed top-0 left-0 w-full z-50 glass border-b border-slate-200/50">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <x-application-logo class="w-10 h-10 fill-current text-indigo-600" />
                <span class="font-outfit text-2xl font-extrabold tracking-tight">Easy<span class="text-indigo-600">Coloc</span></span>
            </div>

            <div class="flex items-center gap-6">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 bg-slate-900 text-white font-bold rounded-full hover:bg-black transition-all shadow-lg shadow-slate-200">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-bold text-slate-600 hover:text-indigo-600 transition-colors">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-6 py-3 bg-indigo-600 text-white font-bold rounded-full hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100 ring-4 ring-indigo-50">Join Now</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <section class="relative pt-40 pb-20 overflow-hidden hero-gradient">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
            <div class="relative z-10">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-50 border border-indigo-100 rounded-full text-indigo-600 text-sm font-bold mb-6">
                    <span class="flex h-2 w-2 rounded-full bg-indigo-600 animate-pulse"></span>
                    Smart Roommate Management
                </div>
                <h1 class="font-outfit text-5xl md:text-7xl font-black leading-tight tracking-tighter mb-6">
                    The Modern Way to <span class="gradient-text">Share Expenses.</span>
                </h1>
                <p class="text-xl text-slate-600 mb-10 leading-relaxed max-w-xl">
                    Stop the roommate drama. EasyColoc helps you track bills, split costs, and manage your colocation without lifting a finger.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-indigo-600 text-white font-bold rounded-2xl hover:bg-indigo-700 transition-all shadow-xl shadow-indigo-200 text-center text-lg">
                        Get Started for Free
                    </a>
                    <a href="#features" class="px-8 py-4 bg-white text-slate-900 font-bold rounded-2xl border border-slate-200 hover:bg-slate-50 transition-all text-center text-lg shadow-sm">
                        See How it Works
                    </a>
                </div>
                <div class="mt-12 flex items-center gap-4">
                    <div class="flex -space-x-3">
                        <img src="https://i.pravatar.cc/100?u=1" class="w-10 h-10 rounded-full border-2 border-white shadow-sm" alt="User">
                        <img src="https://i.pravatar.cc/100?u=2" class="w-10 h-10 rounded-full border-2 border-white shadow-sm" alt="User">
                        <img src="https://i.pravatar.cc/100?u=3" class="w-10 h-10 rounded-full border-2 border-white shadow-sm" alt="User">
                    </div>
                    <p class="text-sm text-slate-500 font-medium">Joined by <span class="text-slate-900 font-bold">2,000+</span> roommates this month</p>
                </div>
            </div>

            <div class="relative">
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[140%] h-[140%] bg-indigo-400 opacity-10 rounded-full blur-[120px]"></div>
                <div class="relative rounded-[3rem] overflow-hidden shadow-2xl skew-y-3 transform hover:skew-y-0 transition-transform duration-700 animate-float bg-slate-100 border-8 border-white">
                    <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Beautiful Interior" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                    <div class="absolute bottom-10 left-10 text-white">
                        <div class="glass p-6 rounded-3xl text-slate-900">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center text-white font-bold text-xl">✓</div>
                                <div>
                                    <p class="text-sm font-bold opacity-60">Rent Paid</p>
                                    <p class="text-lg font-black tracking-tight">€450.00 Settle Up</p>
                                </div>
                            </div>
                            <div class="w-48 h-2 bg-slate-200 rounded-full overflow-hidden">
                                <div class="w-3/4 h-full bg-indigo-600"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <div id="features" class="py-32 bg-white relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-20">
                <h2 class="font-outfit text-4xl md:text-5xl font-black mb-6 tracking-tight">Everything you need <br>for a <span class="text-indigo-600">happy colocation.</span></h2>
                <p class="text-xl text-slate-500 max-w-2xl mx-auto">Focus on making memories with your roommates, while we handle the boring financial stuff.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                {{-- Feature 1 --}}
                <div class="group p-10 bg-slate-50 rounded-[2.5rem] border border-transparent hover:border-indigo-100 hover:bg-white transition-all hover:shadow-2xl hover:shadow-indigo-100/50">
                    <div class="w-16 h-16 bg-indigo-600 rounded-2xl flex items-center justify-center text-white mb-8 group-hover:scale-110 transition-transform shadow-lg shadow-indigo-100">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 font-outfit">Expense Splitting</h3>
                    <p class="text-slate-500 leading-relaxed font-medium">Instantly split bills, rent, and groceries. No more complex spreadsheets or chasing people for money.</p>
                </div>

                {{-- Feature 2 --}}
                <div class="group p-10 bg-slate-50 rounded-[2.5rem] border border-transparent hover:border-indigo-100 hover:bg-white transition-all hover:shadow-2xl hover:shadow-indigo-100/50">
                    <div class="w-16 h-16 bg-blue-500 rounded-2xl flex items-center justify-center text-white mb-8 group-hover:scale-110 transition-transform shadow-lg shadow-blue-100">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 font-outfit">Group Management</h3>
                    <p class="text-slate-500 leading-relaxed font-medium">Create multiple colocations, manage memberships, and maintain clear records of everyone's balance.</p>
                </div>

                {{-- Feature 3 --}}
                <div class="group p-10 bg-slate-50 rounded-[2.5rem] border border-transparent hover:border-indigo-100 hover:bg-white transition-all hover:shadow-2xl hover:shadow-indigo-100/50">
                    <div class="w-16 h-16 bg-emerald-500 rounded-2xl flex items-center justify-center text-white mb-8 group-hover:scale-110 transition-transform shadow-lg shadow-emerald-100">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 font-outfit">Real-time Balances</h3>
                    <p class="text-slate-500 leading-relaxed font-medium">See who owes whom at a glance. Our advanced engine calculates the simplest way for everyone to settle up.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <footer class="bg-slate-50 border-t border-slate-200 py-20">
        <div class="max-w-7xl mx-auto px-6 flex flex-col items-center text-center">
            <x-application-logo class="w-12 h-12 fill-current text-indigo-600 mb-6" />
            <p class="text-lg font-bold font-outfit tracking-tight mb-8">Easy<span class="text-indigo-600">Coloc</span></p>
            <div class="flex gap-10 mb-12">
                <a href="#" class="font-bold text-slate-400 hover:text-slate-900 transition-colors">Documentation</a>
                <a href="#" class="font-bold text-slate-400 hover:text-slate-900 transition-colors">Privacy</a>
                <a href="#" class="font-bold text-slate-400 hover:text-slate-900 transition-colors">Support</a>
            </div>
            <p class="text-sm text-slate-400 font-semibold tracking-widest uppercase">&copy; {{ date('Y') }} EasyColoc. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
