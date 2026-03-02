@php
    $toasts = [];

    if (session('success'))  $toasts[] = ['type' => 'success', 'msg' => session('success')];
    if (session('error'))    $toasts[] = ['type' => 'error',   'msg' => session('error')];
    if (session('warning'))  $toasts[] = ['type' => 'warning', 'msg' => session('warning')];
    if (session('info'))     $toasts[] = ['type' => 'info',    'msg' => session('info')];

    // 'status' keys are sometimes codes like 'profile-updated', 'password-updated', etc.
    if (session('status')) {
        $statusMap = [
            'profile-updated'          => ['type' => 'success', 'msg' => 'Profile updated successfully.'],
            'password-updated'         => ['type' => 'success', 'msg' => 'Password updated successfully.'],
            'verification-link-sent'   => ['type' => 'info',    'msg' => 'Verification link sent to your email.'],
        ];
        $raw = session('status');
        $toasts[] = $statusMap[$raw] ?? ['type' => 'info', 'msg' => $raw];
    }
@endphp

@if (count($toasts))
<div
    id="toast-container"
    class="fixed bottom-5 right-5 z-[9999] flex flex-col gap-3 w-80 pointer-events-none"
    x-data="toastManager({{ json_encode($toasts) }})"
    x-init="init()"
>
    <template x-for="(toast, i) in visible" :key="toast.id">
        <div
            class="flex items-start gap-3 px-4 py-3 rounded-xl shadow-xl text-sm font-medium pointer-events-auto
                   transition-all duration-500 ease-out"
            :class="{
                'bg-emerald-600 text-white': toast.type === 'success',
                'bg-red-600 text-white':     toast.type === 'error',
                'bg-amber-500 text-white':   toast.type === 'warning',
                'bg-blue-600 text-white':    toast.type === 'info',
            }"
            x-show="toast.show"
            x-transition:enter="translate-x-0 opacity-100"
            x-transition:enter-start="translate-x-20 opacity-0"
            x-transition:enter-end="translate-x-0 opacity-100"
            x-transition:leave="translate-x-0 opacity-100"
            x-transition:leave-start="translate-x-0 opacity-100"
            x-transition:leave-end="translate-x-20 opacity-0"
        >
            {{-- Icon --}}
            <div class="mt-0.5 shrink-0">
                <template x-if="toast.type === 'success'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                </template>
                <template x-if="toast.type === 'error'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </template>
                <template x-if="toast.type === 'warning'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
                </template>
                <template x-if="toast.type === 'info'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20A10 10 0 0012 2z"/></svg>
                </template>
            </div>

            {{-- Message --}}
            <span x-text="toast.msg" class="flex-1 leading-snug"></span>

            {{-- Close button --}}
            <button @click="dismiss(i)" class="ml-1 shrink-0 opacity-70 hover:opacity-100 transition-opacity">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    </template>
</div>

<script>
function toastManager(toasts) {
    return {
        visible: toasts.map((t, i) => ({ ...t, id: i, show: false })),
        init() {
            this.visible.forEach((t, i) => {
                setTimeout(() => { t.show = true; }, i * 150);
                setTimeout(() => { this.dismiss(i); }, 4500 + i * 150);
            });
        },
        dismiss(i) {
            if (this.visible[i]) this.visible[i].show = false;
        }
    };
}
</script>
@endif
