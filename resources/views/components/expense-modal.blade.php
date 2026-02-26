{{-- Expense Modal --}}
@props(['categories'])

<div x-data="{ open: false }" @toggle-expense.window="open = !open">
    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         @click="open = false" class="fixed inset-0 z-40 bg-gray-900/60 backdrop-blur-sm"></div>

    <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95 translate-y-4" x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-95 translate-y-4"
         @click.self="open = false" class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden">
            {{-- Header --}}
            <div class="px-6 pt-6 pb-4 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center shadow-sm">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">New Expense</h3>
                            <p class="text-xs text-gray-500">Record a shared expense</p>
                        </div>
                    </div>
                    <button @click="open = false" class="w-8 h-8 rounded-lg hover:bg-gray-100 flex items-center justify-center text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('expenses.store') }}" class="p-6 space-y-5">
                @csrf
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-1.5">Title</label>
                    <input type="text" name="title" id="title" placeholder="e.g. Groceries, Electricity bill"
                        class="block w-full border border-gray-200 rounded-xl py-2.5 px-4 text-sm bg-gray-50 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-200 placeholder-gray-400" required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="amount" class="block text-sm font-semibold text-gray-700 mb-1.5">Amount (MAD)</label>
                        <input type="number" name="amount" id="amount" max="1000000" min="0" step="0.01" placeholder="0.00"
                            class="block w-full border border-gray-200 rounded-xl py-2.5 px-4 text-sm bg-gray-50 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-200 placeholder-gray-400" required>
                    </div>
                    <div>
                        <label for="date" class="block text-sm font-semibold text-gray-700 mb-1.5">Date</label>
                        <input type="date" name="date" id="date"
                            class="block w-full border border-gray-200 rounded-xl py-2.5 px-4 text-sm bg-gray-50 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-200" required>
                    </div>
                </div>

                <div>
                    <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-1.5">Category</label>
                    <select name="category_id" id="category_id"
                        class="block w-full border border-gray-200 rounded-xl py-2.5 px-4 text-sm bg-gray-50 focus:bg-white focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all duration-200 appearance-none" required>
                        <option value="" disabled selected>Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Actions --}}
                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" @click="open = false"
                        class="px-5 py-2.5 text-sm font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors duration-200">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-5 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 rounded-xl shadow-sm shadow-emerald-200 transition-all duration-200 hover:shadow-md active:scale-95">
                        Add Expense
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
