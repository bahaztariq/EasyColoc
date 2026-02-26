{{-- Balances Section (Who Owes Who) --}}
@props(['members', 'expenses'])

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="p-5 border-b border-gray-50">
        <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-lg bg-rose-50 flex items-center justify-center">
                <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
            </div>
            <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Who Owes Who</h3>
        </div>
    </div>

    <div class="p-4 space-y-3">
        {{-- TODO: Add your debt calculation logic here --}}
        {{-- Each debt row: from (debtor) → amount → to (creditor) --}}

        {{-- Example static row --}}
        <div class="flex items-center gap-3 px-3 py-3 rounded-xl bg-gray-50/50">
            <div class="flex items-center gap-2 min-w-0 flex-1">
                <div class="w-8 h-8 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center text-xs font-bold uppercase shrink-0">
                    ?
                </div>
                <span class="text-sm font-semibold text-gray-800 truncate">Debtor</span>
            </div>

            <div class="flex flex-col items-center shrink-0 px-2">
                <span class="text-xs font-bold text-rose-500">0.00 MAD</span>
                <svg class="w-5 h-5 text-gray-300 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </div>

            <div class="flex items-center gap-2 min-w-0 flex-1 justify-end">
                <span class="text-sm font-semibold text-gray-800 truncate">Creditor</span>
                <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center text-xs font-bold uppercase shrink-0">
                    ?
                </div>
            </div>
        </div>
    </div>
</div>
