<div>
    <img
        src="{{ auth()->user()->avatar }}"
        x-on:update-user-profile-picture.window="$wire.$refresh()"
    />
</div>
