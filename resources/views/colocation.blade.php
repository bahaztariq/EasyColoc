<x-app-layout>
    @if($colocation)
    <x-slot name="header">
        <div class="flex flex-col w-full sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-md shadow-indigo-200">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900 tracking-tight">{{ $colocation->name }}</h2>
                    <p class="text-xs text-gray-400 mt-0.5">Shared living · {{ $colocation->currentMembers->count() }} members</p>
                </div>
            </div>
            @if($colocation->owner_id === auth()->id())
            <div class="flex items-center gap-2" x-data>
                <button @click="$dispatch('toggle-category')"
                    class="inline-flex items-center gap-1.5 px-3.5 py-2 text-xs font-semibold text-violet-600 bg-violet-50 hover:bg-violet-100 border border-violet-200 rounded-xl transition-all duration-200 active:scale-95">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                    Add Category
                </button>
            </div>
            @endif
        </div>
    </x-slot>

    <x-invite-member-modal :colocation="$colocation" />
    <x-expense-modal :categories="$colocation->categories" />
    <x-create-colocation-modal />
    <x-category-modal />

    {{-- Content --}}
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Stats Row --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="relative overflow-hidden bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-5 shadow-md shadow-blue-200/50">
                    <div class="relative z-10">
                        <p class="text-3xl font-extrabold text-white">{{ $colocation->currentMembers->count() }}</p>
                        <p class="text-blue-100 text-xs font-medium mt-1">Members</p>
                    </div>
                    <div class="absolute -right-3 -bottom-3 w-16 h-16 bg-white/10 rounded-full"></div>
                </div>
                <div class="relative overflow-hidden bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl p-5 shadow-md shadow-emerald-200/50">
                    <div class="relative z-10">
                        <p class="text-3xl font-extrabold text-white">{{ $colocation->expenses->count() }}</p>
                        <p class="text-emerald-100 text-xs font-medium mt-1">Expenses</p>
                    </div>
                    <div class="absolute -right-3 -bottom-3 w-16 h-16 bg-white/10 rounded-full"></div>
                </div>
                <div class="relative overflow-hidden bg-gradient-to-br from-amber-500 to-orange-500 rounded-2xl p-5 shadow-md shadow-amber-200/50">
                    <div class="relative z-10">
                        <p class="text-3xl font-extrabold text-white">{{ number_format($colocation->expenses->sum('amount'), 0) }}</p>
                        <p class="text-amber-100 text-xs font-medium mt-1">Total MAD</p>
                    </div>
                    <div class="absolute -right-3 -bottom-3 w-16 h-16 bg-white/10 rounded-full"></div>
                </div>
                <div class="relative overflow-hidden bg-gradient-to-br from-violet-500 to-purple-600 rounded-2xl p-5 shadow-md shadow-violet-200/50">
                    <div class="relative z-10">
                        @php $share = $colocation->members->count() > 0 ? $colocation->expenses->sum('amount') / $colocation->members->count() : 0; @endphp
                        <p class="text-3xl font-extrabold text-white">{{ number_format($share, 0) }}</p>
                        <p class="text-violet-100 text-xs font-medium mt-1">Per Person</p>
                    </div>
                    <div class="absolute -right-3 -bottom-3 w-16 h-16 bg-white/10 rounded-full"></div>
                </div>
            </div>

            {{-- Main Grid: Members + Balances | Expenses --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                {{-- Left Column --}}
                <div class="lg:col-span-4 space-y-6">
                    <x-members-section :members="$colocation->currentMembers" :colocation="$colocation" />
                    <x-balances-section :balances="$balances" />
                </div>

                {{-- Right Column --}}
                <div class="lg:col-span-8">
                    <x-expenses-section :expenses="$colocation->expenses" />
                </div>
            </div>
        </div>
    </div>

    @else
    {{-- No Colocation --}}
    <div class="flex flex-col items-center justify-center min-h-[70vh] px-4" x-data>
        <div class="text-center max-w-sm">
            <div class="relative w-24 h-24 mx-auto mb-8">
                <div class="absolute inset-0 rounded-3xl bg-gradient-to-br from-indigo-500 to-purple-600 shadow-xl shadow-indigo-200 animate-pulse opacity-20"></div>
                <div class="relative w-24 h-24 rounded-3xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-xl shadow-indigo-200">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                </div>
            </div>
            <h2 class="text-3xl font-extrabold text-gray-900 mb-3">Welcome to EasyColoc</h2>
            <p class="text-gray-500 mb-10 leading-relaxed">Create your first colocation to start splitting expenses with your roommates effortlessly.</p>
            <button @click="$dispatch('toggle-create-colocation')"
                class="inline-flex items-center gap-2 px-8 py-3.5 text-sm font-bold text-white bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 rounded-2xl shadow-lg shadow-indigo-200 transition-all duration-300 hover:shadow-xl hover:-translate-y-0.5 active:scale-95">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                Create a Colocation
            </button>
        </div>
    </div>
    <x-create-colocation-modal />
    @endif
</x-app-layout>
