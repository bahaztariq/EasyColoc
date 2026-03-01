{{-- Sidebar --}}
@php $user = Auth::user(); @endphp

<aside class="fixed inset-y-0 left-0 z-30 w-64 bg-white border-r border-gray-100 flex flex-col transform transition-transform duration-300 lg:translate-x-0"
       x-data="{ mobileOpen: false }"
       :class="mobileOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
       @toggle-sidebar.window="mobileOpen = !mobileOpen">

    {{-- Logo --}}
    <div class="h-16 flex items-center gap-2.5 px-6 border-b border-gray-50 shrink-0">
        <a href="{{ route('colocation.index') }}" class="flex items-center gap-2.5">
            <x-application-logo class="h-9 w-auto" />
            <span class="text-xl font-bold text-gray-900 tracking-tight">
                Easy<span class="text-blue-600">Coloc</span>
            </span>
        </a>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-1">
        @if(auth()->user()->is_admin)
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors
                      {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                Admin Dashboard
            </a>
        @endif
        <a href="{{ route('colocation.index') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors
                  {{ request()->routeIs('colocation.index') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Colocation
        </a>
        <a href="{{ route('profile.edit') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors
                  {{ request()->routeIs('profile.edit') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            Profile
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Log Out
            </button>
        </form>
    </nav>

    {{-- Bottom: User Info + Leave --}}
    <div class="border-t border-gray-100 p-4 space-y-3 shrink-0">
        {{-- User Card --}}
        <div class="flex items-center gap-3 px-2">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm uppercase shadow-sm">
                {{ substr($user->name, 0, 1) }}
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-sm font-semibold text-gray-900 truncate">{{ $user->name }}</p>
                <p class="text-xs text-gray-400 truncate">{{ $user->email }}</p>
            </div>
        </div>

        {{-- Reputation Points --}}
        <div class="flex items-center justify-between px-3 py-2.5 bg-amber-50 border border-amber-200 rounded-xl">
            <div class="flex items-center gap-2">
                <span class="text-lg">⭐</span>
                <span class="text-xs font-semibold text-amber-700">Reputation Points</span>
            </div>
            <span class="text-sm font-extrabold text-amber-600">{{ $user->ReputationScore ?? 0 }}</span>
        </div>

        {{-- Leave Colocation --}}
        @if($user->colocation_id)
            <form method="POST" action="{{ route('colocation.leave') }}"
                  onsubmit="return confirm('Are you sure you want to leave this colocation?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 px-3 py-2 text-xs font-semibold text-amber-600 bg-amber-50 hover:bg-amber-100 border border-amber-200 rounded-xl transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Leave Colocation
                </button>
            </form>
        @endif
    </div>
</aside>

{{-- Mobile overlay --}}
<div x-data @toggle-sidebar.window="$el.classList.toggle('hidden')"
     @click="$dispatch('toggle-sidebar')"
     class="hidden fixed inset-0 z-20 bg-gray-900/50 backdrop-blur-sm lg:hidden"></div>
