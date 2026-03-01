<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-8">
        <h3 class="text-2xl font-bold text-slate-900 font-outfit">Welcome Back</h3>
        <p class="text-slate-500 text-sm mt-1">Please enter your credentials to continue</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-1.5" />
            <x-text-input id="email" 
                          class="block w-full bg-slate-50/50 border-slate-100 focus:bg-white focus:ring-indigo-500 rounded-xl transition-all duration-200" 
                          type="email" 
                          name="email" 
                          :value="old('email')" 
                          required 
                          autofocus 
                          placeholder="name@example.com"
                          autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-1.5">
                <x-input-label for="password" :value="__('Password')" class="text-xs font-bold uppercase tracking-wider text-slate-400" />
                @if (Route::has('password.request'))
                    <a class="text-xs font-bold text-indigo-600 hover:text-indigo-700 transition-colors" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <x-text-input id="password" 
                          class="block w-full bg-slate-50/50 border-slate-100 focus:bg-white focus:ring-indigo-500 rounded-xl transition-all duration-200"
                          type="password"
                          name="password"
                          placeholder="••••••••"
                          required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" class="w-4 h-4 rounded border-slate-200 text-indigo-600 focus:ring-indigo-500 focus:ring-offset-0 transition-all cursor-pointer" name="remember">
            <label for="remember_me" class="ms-2 text-sm text-slate-500 font-medium cursor-pointer select-none">{{ __('Remember me') }}</label>
        </div>

        <div>
            <x-primary-button class="w-full justify-center py-4 bg-indigo-600 hover:bg-indigo-700 shadow-lg shadow-indigo-100/50 rounded-xl transition-all duration-200 text-sm font-bold tracking-wide">
                {{ __('SIGN IN') }}
            </x-primary-button>
        </div>

        @if (Route::has('register'))
            <p class="text-center text-sm text-slate-500 font-medium pt-4">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-indigo-600 font-bold hover:underline underline-offset-4">Create one for free</a>
            </p>
        @endif
    </form>
</x-guest-layout>
