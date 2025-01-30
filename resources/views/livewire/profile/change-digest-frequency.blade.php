<section class="space-y-4">
    <div>
        <h1 class="font-semibold">
            Email Digest Frequency
        </h1>
        <h2 class="text-sm">
            Choose how often you'd like to receive updates in your inbox.
        </h2>
    </div>
    <form class="space-y-2">
        <select
            class="select select-bordered w-full focus:outline-none focus:border-2 focus:border-primary h-10 dark:bg-stone-900"
            wire:model="frequency"
            wire:change="change"
        >
            @foreach ($frequencies as $digestFrequency)
                <option value="{{ $digestFrequency->value }}">
                    {{ $digestFrequency->label() }}
                </option>
            @endforeach
        </select>
        @error('frequency')
            <div class="text-sm text-red-500 mt-2">
                {{ $message }}
            </div>
        @enderror
        <x-action-message
            class="me-3"
            on="digest-frequency-update"
        >
            Saved.
        </x-action-message>
    </form>
</section>
