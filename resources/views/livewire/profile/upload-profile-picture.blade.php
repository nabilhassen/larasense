<div class="cursor-pointer">
    @filepondScripts

    <x-filepond::upload
        wire:model="file"
        stylePanelLayout="circle"
        placeholder="Upload your profile picture"
        credits="false"
        :files="blank(auth()->user()->avatar_url) ? auth()->user()->avatar_url : auth()->user()->avatar"
    />
</div>
