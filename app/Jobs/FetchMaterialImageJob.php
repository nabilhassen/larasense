<?php

namespace App\Jobs;

use App\Models\Material;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class FetchMaterialImageJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public int $materialId)
    {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $material = Material::find($this->materialId, ['id', 'image_url']);

        if (!isset(parse_url($material->image_url)['host'])) {
            return;
        }

        $response = Http::retry(3, 100)->timeout(10)->get($material->image_url);

        $path = $this->getPath($response->header('Content-Type'));

        Storage::disk('public')->put($path, $response->body());

        $material->image_url = $path;

        $material->save();

        $image = Image::read(Storage::disk('public')->path($material->image_url));

        $image->scale(height: 160);

        $image->save();
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
