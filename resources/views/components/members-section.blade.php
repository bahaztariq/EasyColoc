{{-- Members Section --}}
@props(['members', 'colocation'])

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="p-5 border-b border-gray-50">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Members</h3>
                <span class="text-xs font-semibold text-gray-400 bg-gray-50 px-2.5 py-1 rounded-lg">{{ $members->count() }}</span>
            </div>
            @if($colocation->owner_id === auth()->id())
            <div x-data>
                <button @click="$dispatch('toggle-invite')"
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-white bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 rounded-lg shadow-sm transition-all duration-200 hover:shadow-md active:scale-95">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                    Invite
                </button>
            </div>
            @endif
        </div>
    </div>

    <div class="p-2">
        @if($members->isEmpty())
            <div class="px-4 py-8 text-center">
                <p class="text-gray-400 text-sm">No members yet.</p>
            </div>
        @else
            @foreach($members as $member)
                @php $isOwner = $colocation->owner_id === $member->id; @endphp
                <div class="flex items-center justify-between px-3 py-2.5 rounded-xl hover:bg-gray-50 transition-colors group">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl {{ $isOwner ? 'bg-gradient-to-br from-amber-400 to-orange-500 text-white' : 'bg-gray-100 text-gray-600' }} flex items-center justify-center font-bold text-sm uppercase shadow-sm">
                            {{ substr($member->name, 0, 1) }}
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <p class="text-sm font-semibold text-gray-800">{{ $member->name }}</p>
                                <span class="inline-flex items-center gap-0.5 text-xs font-semibold text-amber-600 bg-amber-50 px-1.5 py-0.5 rounded-md">
                                    ⭐ {{ $member->ReputationScore ?? 0 }}
                                </span>
                            </div>
                            <p class="text-xs text-gray-400">{{ $member->email }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-semibold px-2.5 py-1 rounded-lg
                            {{ $isOwner ? 'bg-amber-50 text-amber-600' : 'bg-gray-50 text-gray-500' }}">
                            {{ $isOwner ? 'Owner' : 'Member' }}
                        </span>

                        @if($colocation->owner_id === auth()->id() && !$isOwner)
                        <form action="{{ route('colocation.kick', $member) }}" method="POST" onsubmit="return confirm('Are you sure you want to kick this member?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1.5 text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Kick member">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7a4 4 0 11-8 0 4 4 0 018 0zM9 14a6 6 0 00-6 6v1h12v-1a6 6 0 00-6-6zM21 12h-6"/></svg>
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
