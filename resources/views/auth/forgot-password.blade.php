<x-guest-layout>
    <div class="mb-8">
        <h3 class="text-2xl font-bold text-slate-900 font-outfit lowercase tracking-tight">Recover Password</h3>
        <p class="text-slate-500 text-sm mt-1">
            {{ __('Forgot your password? No problem. Enter your email address and we\'ll send you a reset link.') }}
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-1.5" />
            <x-text-input id="email" 
                          class="block w-full bg-slate-50/50 border-slate-100 focus:bg-white focus:ring-indigo-500 rounded-xl transition-all duration-200" 
                          type="email" 
                          name="email" 
                          :value="old('email')" 
                          placeholder="name@example.com"
                          required 
                          autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-primary-button class="w-full justify-center py-4 bg-indigo-600 hover:bg-indigo-700 shadow-lg shadow-indigo-100/50 rounded-xl transition-all duration-200 text-sm font-bold tracking-wide">
                {{ __('EMAIL RESET LINK') }}
            </x-primary-button>
        </div>

        <p class="text-center text-sm text-slate-500 font-medium pt-2">
            Remembered your password? 
            <a href="{{ route('login') }}" class="text-indigo-600 font-bold hover:underline underline-offset-4">Back to sign in</a>
        </p>
    </form>
</x-guest-layout>
