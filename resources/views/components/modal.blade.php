@props([
    'name',
    'show' => false,
    'maxWidth' => '2xl'
])

@php
$maxWidth = [
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
][$maxWidth];
@endphp

<div
    x-data="{
        show: @js($show),
        focusables() {
            let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, [tabindex]:not([tabindex=\'-1\'])'
            return [...$el.querySelectorAll(selector)]
                .filter(el => ! el.hasAttribute('disabled'))
        },
        firstFocusable() { return this.focusables()[0] },
        lastFocusable() { return this.focusables().slice(-1)[0] },
        nextFocusable() { return this.focusables()[this.focusables().indexOf(document.activeElement) + 1] || (this.firstFocusable() && this.firstFocusable()) },
        prevFocusable() { return this.focusables()[this.focusables().indexOf(document.activeElement) - 1] || (this.lastFocusable() && this.lastFocusable()) },
        showModal() {
            this.show = true
            document.body.style.overflow = 'hidden'
        },
        closeModal() {
            this.show = false
            document.body.style.overflow = 'auto'
        }
    }"
    x-init="$watch('show', value => {
        if (value) {
            document.body.style.overflow = 'hidden'
        } else {
            document.body.style.overflow = 'auto'
        }
    })"
    x-on:open-modal.window="$event.detail == '{{ $name }}' ? showModal() : null"
    x-on:close-modal.window="$event.detail == '{{ $name }}' ? closeModal() : null"
    x-on:close.stop="closeModal()"
    x-on:keydown.escape.window="closeModal()"
    x-on:keydown.tab.prevent="$event.shiftKey ? prevFocusable().focus() : nextFocusable().focus()"
    x-show="show"
    class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50"
    style="display: none;"
>
    <!-- Background Overlay -->
    <div
        x-show="show"
        class="fixed inset-0 transform transition-all"
        x-on:click="closeModal()"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div class="absolute inset-0 bg-slate-950/90 backdrop-blur-sm"></div>
    </div>

    <!-- Modal Content -->
    <div
        x-show="show"
        class="mb-6 bg-slate-900 border border-slate-800 shadow-2xl transform transition-all sm:w-full {{ $maxWidth }} sm:mx-auto"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    >
        {{ $slot }}
    </div>
</div>