<dialog
    wire:ignore.self
    class="modal cursor-auto"
    x-data="{ message: 'To engage with content' }"
    x-on:open-login-required-modal.window="() => {
        $el.showModal();
        message = $event.detail.message;
    }"
>
    <div class="modal-box py-8 dark:bg-black dark:border-2 dark:border-stone-800 space-y-4">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-lg">
                Login Required.
            </h2>
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost">✕</button>
            </form>
        </div>
        <div class="text-sm items-start">
            <span x-text="message"></span>, please <a
                wire:navigate
                class="link text-primary"
                href="{{ route('login') }}"
            >Login</a> first.
        </div>
    </div>
    <form
        method="dialog"
        class="modal-backdrop backdrop-blur-sm"
    >
        <button>close</button>
    </form>
</dialog>
