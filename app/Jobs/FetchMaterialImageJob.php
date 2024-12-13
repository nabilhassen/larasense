<?php

namespace App\Jobs;

use App\Models\Material;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FetchMaterialImageJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public int $materialId, public ?string $imageUrl = null)
    {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (is_null($this->imageUrl)) {
            return;
        }

        $material = Material::find($this->materialId);

        $path = str('materials/')->append(Str::random(), '/', str($this->imageUrl)->afterLast('.')->toString());

        $content = file_get_contents($this->imageUrl);

        if (!$content) {
            $this->fail();
        }

        Storage::disk('public')->put($path, $content);

        $material->image_url = $path;

        $material->save();
    }
}
