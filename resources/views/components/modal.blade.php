@props([
    'name',
    'show' => false,
    'maxWidth' => '2xl'
])

@php
$maxWidth = [
    'sm' => 'max-w-sm',
    'md' => 'max-w-md',
    'lg' => 'max-w-lg',
    'xl' => 'max-w-xl',
    '2xl' => 'max-w-2xl',
][$maxWidth];
@endphp

<dialog
    id="{{ $name }}"
    class="modal cursor-auto"
    x-data="{
        focusables() {
            let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'
            return [...$el.querySelectorAll(selector)]
                .filter(el => ! el.hasAttribute('disabled'))
        },
        firstFocusable() { return this.focusables()[0] },
        open() {
            if (! $el.open) {
                $el.showModal()
            }

            {{ $attributes->has('focusable') ? 'setTimeout(() => this.firstFocusable()?.focus(), 100)' : '' }}
        },
        close() {
            if ($el.open) {
                $el.close()
            }
        },
    }"
    x-init="@js($show) && $nextTick(() => open())"
    x-on:open-modal.window="$event.detail === '{{ $name }}' && open()"
    x-on:close-modal.window="$event.detail === '{{ $name }}' && close()"
    x-on:close.stop="close()"
>
    <div class="modal-box w-full {{ $maxWidth }} dark:bg-black dark:border dark:border-stone-800">
        {{ $slot }}
    </div>

    <form
        method="dialog"
        class="modal-backdrop backdrop-blur-xs"
    >
        <button>close</button>
    </form>
</dialog>
