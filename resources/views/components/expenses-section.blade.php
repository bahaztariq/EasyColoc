{{-- Expenses Section --}}
@props(['expenses'])

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="p-5 border-b border-gray-50">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Expenses</h3>
                <span class="text-xs font-semibold text-gray-400 bg-gray-50 px-2.5 py-1 rounded-lg">{{ $expenses->count() }}</span>
            </div>
            <div x-data>
                <button @click="$dispatch('toggle-expense')"
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-white bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 rounded-lg shadow-sm transition-all duration-200 hover:shadow-md active:scale-95">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                    Add Expense
                </button>
            </div>
        </div>
    </div>

    @if($expenses->isEmpty())
        <div class="px-6 py-12 text-center">
            <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-gray-50 flex items-center justify-center">
                <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2 3.5 2z"/></svg>
            </div>
            <p class="text-gray-400 text-sm font-medium">No expenses recorded yet</p>
            <p class="text-gray-300 text-xs mt-1">Add your first expense to get started</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-xs text-gray-400 uppercase tracking-wider border-b border-gray-50">
                        <th class="px-5 py-3 text-left font-semibold">Title</th>
                        <th class="px-5 py-3 text-left font-semibold">Category</th>
                        <th class="px-5 py-3 text-left font-semibold">Paid by</th>
                        <th class="px-5 py-3 text-right font-semibold">Amount</th>
                        <th class="px-5 py-3 text-right font-semibold">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($expenses->sortByDesc('expense_date') as $expense)
                        <tr class="border-b border-gray-50 last:border-0 hover:bg-gray-50/50 transition-colors">
                            <td class="px-5 py-3.5">
                                <span class="font-semibold text-gray-800">{{ $expense->title }}</span>
                            </td>
                            <td class="px-5 py-3.5">
                                @if($expense->category)
                                    <span class="inline-flex items-center px-2.5 py-0.5 text-xs font-semibold rounded-lg bg-violet-50 text-violet-600">
                                        {{ $expense->category->name }}
                                    </span>
                                @else
                                    <span class="text-gray-300">—</span>
                                @endif
                            </td>
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-md bg-gray-100 text-gray-500 flex items-center justify-center text-xs font-bold uppercase">
                                        {{ substr($expense->payer->name ?? '?', 0, 1) }}
                                    </div>
                                    <span class="text-gray-600 font-medium">{{ $expense->payer->name ?? '—' }}</span>
                                </div>
                            </td>
                            <td class="px-5 py-3.5 text-right">
                                <span class="font-bold text-gray-900">{{ number_format($expense->amount, 2) }}</span>
                                <span class="text-xs text-gray-400 ml-0.5">MAD</span>
                            </td>
                            <td class="px-5 py-3.5 text-right text-gray-400 text-xs font-medium">
                                {{ \Carbon\Carbon::parse($expense->expense_date)->format('M d, Y') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
