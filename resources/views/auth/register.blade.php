<x-guest-layout>
    <div class="mb-8 text-center sm:text-left">
        <h3 class="text-2xl font-bold text-slate-900 font-outfit uppercase tracking-tight">Create Account</h3>
        <p class="text-slate-500 text-sm mt-1">Join the community and start splitting expenses</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-1.5" />
            <x-text-input id="name" 
                          class="block w-full bg-slate-50/50 border-slate-100 focus:bg-white focus:ring-indigo-500 rounded-xl transition-all duration-200" 
                          type="text" 
                          name="name" 
                          :value="old('name')" 
                          placeholder="Your Name"
                          required 
                          autofocus 
                          autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

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
                          autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <x-input-label for="password" :value="__('Password')" class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-1.5" />
                <x-text-input id="password" 
                              class="block w-full bg-slate-50/50 border-slate-100 focus:bg-white focus:ring-indigo-500 rounded-xl transition-all duration-200"
                              type="password"
                              name="password"
                              placeholder="••••••••"
                              required 
                              autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm')" class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-1.5" />
                <x-text-input id="password_confirmation" 
                              class="block w-full bg-slate-50/50 border-slate-100 focus:bg-white focus:ring-indigo-500 rounded-xl transition-all duration-200"
                              type="password"
                              name="password_confirmation" 
                              placeholder="••••••••"
                              required 
                              autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="pt-4">
            <x-primary-button class="w-full justify-center py-4 bg-indigo-600 hover:bg-indigo-700 shadow-lg shadow-indigo-100/50 rounded-xl transition-all duration-200 text-sm font-bold tracking-wide">
                {{ __('SIGN UP') }}
            </x-primary-button>
        </div>

        <p class="text-center text-sm text-slate-500 font-medium pt-2">
            Already registered? 
            <a href="{{ route('login') }}" class="text-indigo-600 font-bold hover:underline underline-offset-4">Sign in here</a>
        </p>
    </form>
</x-guest-layout>
