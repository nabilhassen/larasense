<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\Material;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class FetchAndUpdateMaterialImage implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Material $material) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (! parse_url($this->material->image_url, PHP_URL_HOST)) {
            return;
        }

        $response = Http::retry(3, 100)->timeout(10)->get($this->material->image_url);

        $path = $this->generatePath($response->header('Content-Type'));

        Storage::disk('public')->put($path, $response->body());

        $this->material->update(['image_url' => $path]);

        $image = Image::read(Storage::disk('public')->path($this->material->image_url));

        $image->scale(height: 160);

        $image->save();
    }

    protected function generatePath(string $contentType): string
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
