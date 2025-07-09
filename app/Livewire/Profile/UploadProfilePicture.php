<?php

declare(strict_types=1);

namespace App\Livewire\Profile;

use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Spatie\LivewireFilepond\WithFilePond;

class UploadProfilePicture extends Component
{
    use WithFilePond;

    #[Rule('nullable|file|mimetypes:image/webp,image/jpg,image/jpeg,image/png|max:3000')]
    public $file;

    public function mount()
    {
        $this->file = blank(auth()->user()->avatar_url) ? auth()->user()->avatar_url : auth()->user()->avatar;
    }

    #[On('FilePond:removefile')]
    public function validateUploadedFile()
    {
        $this->validate();

        auth()->user()->update([
            'avatar_url' => $this->file?->store('avatars', 'public'),
        ]);

        if (auth()->user()->wasChanged('avatar_url')) {
            $this->dispatch('update-user-profile-picture');
        }

        return true;
    }

    public function render()
    {
        return view('livewire.profile.upload-profile-picture');
    }
}
