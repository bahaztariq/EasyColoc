{{-- Balances Section (Who Owes Who) --}}
@props(['balances'])

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="p-5 border-b border-gray-50">
        <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-lg bg-rose-50 flex items-center justify-center">
                <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
            </div>
            <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Settlement Summary</h3>
        </div>
    </div>

    <div class="p-4 space-y-3">
        @forelse($balances as $balance)
            <div class="flex items-center gap-3 px-3 py-3 rounded-xl bg-gray-50/50 hover:bg-gray-50 transition-colors">
                <div class="flex items-center gap-2 min-w-0 flex-1">
                    <div class="w-8 h-8 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center text-xs font-bold uppercase shrink-0">
                        {{ substr($balance['debtor']->name, 0, 1) }}
                    </div>
                    <span class="text-sm font-semibold text-gray-800 truncate">{{ $balance['debtor']->name }}</span>
                </div>

                <div class="flex flex-col items-center shrink-0 px-2">
                    <span class="text-xs font-bold text-rose-500">{{ number_format($balance['amount'], 2) }} MAD</span>
                    <svg class="w-5 h-5 text-gray-300 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </div>

                <div class="flex items-center gap-2 min-w-0 flex-1 justify-end relative group">
                    <span class="text-sm font-semibold text-gray-800 truncate">{{ $balance['creditor']->name }}</span>
                    <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center text-xs font-bold uppercase shrink-0">
                        {{ substr($balance['creditor']->name, 0, 1) }}
                    </div>

                    {{-- Mark as Paid Button (Only for Creditor) --}}
                    @if(auth()->id() === $balance['debtor']->id)
                        <form action="{{ route('payments.settle') }}" method="POST" class="ml-2">
                            @csrf
                            <input type="hidden" name="debtor_id" value="{{ $balance['debtor']->id }}">
                            <input type="hidden" name="creditor_id" value="{{ $balance['creditor']->id }}">
                            <button type="submit" 
                                    class="p-1.5 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition-colors shadow-sm focus:ring-2 focus:ring-emerald-200"
                                    title="Mark as Paid"
                                    onclick="return confirm('confirm you paid {{ $balance['creditor']->name }}?')">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center py-6">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-500 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
                <p class="text-xs font-medium text-gray-500">Perfectly settled! No debts found.</p>
            </div>
        @endforelse
    </div>
</div>
