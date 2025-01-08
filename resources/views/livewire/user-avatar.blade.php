<div x-data>
    <img
        loading="lazy"
        src="{{ auth()->user()->avatar }}"
        x-on:update-user-profile-picture.window="$wire.$refresh()"
    />
</div>
