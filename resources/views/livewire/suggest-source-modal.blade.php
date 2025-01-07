<dialog
    wire:ignore.self
    class="modal cursor-auto"
    x-data
    x-on:open-source-suggestions-modal.window="$el.showModal()"
    x-on:close="$wire.isSubmitted && ($wire.isSubmitted = false)"
>
    <div class="modal-box py-8 dark:bg-black dark:border-2 dark:border-stone-800 space-y-4">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-lg">
                Suggest Sources
            </h2>
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost">✕</button>
            </form>
        </div>
        <form
            wire:submit="submit"
            x-show="!$wire.isSubmitted"
        >
            <div>
                <label class="form-control w-full">
                    <div class="label">
                        Source URL
                    </div>
                    <input
                        autofocus
                        wire:model="url"
                        type="text"
                        placeholder="blog.laravel.com"
                        class="input input-bordered focus:outline-none focus:border-2 focus:border-primary h-10 dark:bg-stone-900"
                    />
                </label>
                @error('url')
                    <div class="text-sm text-primary mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="modal-action">
                <button class="btn bg-primary font-bold text-white border-none hover:bg-primary hover:brightness-90">
                    Submit
                </button>
            </div>
        </form>
        <div
            class="alert text-sm items-start bg-primary dark:bg-stone-800 text-white dark:text-stone-300 dark:border-stone-800"
            x-show="$wire.isSubmitted"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 shrink-0 stroke-white"
                fill="none"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                />
            </svg>
            <span>We have received your suggestion. <br> Thank you for your contribution!</span>
        </div>
    </div>
    <form
        method="dialog"
        class="modal-backdrop backdrop-blur-sm"
    >
        <button>close</button>
    </form>
</dialog>
