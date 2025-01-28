<x-layouts.mail>
    <div class="sm:w-[640px] w-11/12 mx-auto p-4 sm:px-8 px-4 bg-white space-y-8 min-h-screen">
        <p class="flex justify-center items-center text-center text-primary font-bold text-lg">
            Weekly Digest
        </p>

        <div class="space-y-8">
            @include('emails.periodic-digest.section', [
                'title' => 'Category Champions',
                'materials' => array_filter([$youtubeMaterials->first(), $articleMaterials->first(), $podcastMaterials->first()]),
                'icon' => 'heroicon-o-trophy',
            ])

            <hr class="border-2 border-dotted border-primary w-2/4 mx-auto">

            @include('emails.periodic-digest.section', [
                'title' => 'Most Watched',
                'materials' => $youtubeMaterials,
                'icon' => 'heroicon-o-video-camera',
            ])

            <hr class="border-2 border-dotted border-primary w-2/4 mx-auto">

            @include('emails.periodic-digest.section', [
                'title' => 'Most Read',
                'materials' => $articleMaterials,
                'icon' => 'heroicon-o-pencil-square',
            ])

            <hr class="border-2 border-dotted border-primary w-2/4 mx-auto">

            @include('emails.periodic-digest.section', [
                'title' => 'Most Listened',
                'materials' => $podcastMaterials,
                'icon' => 'heroicon-o-microphone',
            ])
        </div>
    </div>

    <x-slot:footer>
        <div>
            To change how often you'd like to receive these email digests, please visit your <a
                class="link"
                href="{{ route('settings') }}"
                target="_blank"
            >account settings</a>.
        </div>
    </x-slot:footer>
</x-layouts.mail>
