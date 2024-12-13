<?php

namespace App\Jobs;

use App\Models\Material;
use Exception;
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

        $material = Material::find($this->materialId, ['id', 'image_url']);

        try {
            $response = Http::retry(3, 100)->timeout(10)->get($this->imageUrl);

            $path = $this->getPath($response->header('Content-Type'));

            Storage::disk('public')->put($path, $response->body());

            $material->image_url = $path;

            $material->save();
        } catch (Exception $ex) {
            report($ex);

            $this->release();
        }
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
