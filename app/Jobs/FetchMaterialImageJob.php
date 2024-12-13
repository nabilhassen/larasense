<?php

namespace App\Jobs;

use App\Models\Material;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
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
        if (blank($this->imageUrl)) {
            return;
        }

        $material = Material::find($this->materialId);

        $response = Http::get($this->imageUrl);

        $path = $this->getPath($response->header('Content-Type'));

        $content = file_get_contents($response->body());

        if (!$content) {
            $this->fail();
        }

        Storage::disk('public')->put($path, $content);

        $material->image_url = $path;

        $material->save();
    }

    protected function getPath(string $contentType): string
    {
        $imageExtension = str($contentType)
            ->afterLast('/')
            ->prepend('.')
            ->toString();

        return str('materials/')
            ->append(Str::random())
            ->append($imageExtension)
            ->toString();
    }
}
