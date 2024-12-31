<?php

namespace App\Livewire\Profile;

use Livewire\Attributes\Rule;
use Livewire\Component;
use Spatie\LivewireFilepond\WithFilePond;

class UploadProfilePicture extends Component
{
    use WithFilePond;

    #[Rule('sometimes|required|mimetypes:image/jpg,image/jpeg,image/png|max:3000')]
    public $file;

    public function mount()
    {
        $this->file = 'storage/' . auth()->user()->avatar_url;
    }

    public function validateUploadedFile()
    {
        $this->validate();

        auth()->user()->update([
            'avatar_url' => $this->file->store('avatars', 'public'),
        ]);

        return true;
    }

    public function render()
    {
        return view('livewire.profile.upload-profile-picture');
    }
}
