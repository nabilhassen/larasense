<?php

namespace App\Actions;

use App\Models\Material;
use App\Models\Source;

class CreateMaterial
{
    public static function handle(int $sourceId, array $data): Material
    {
        $source = Source::find($sourceId);

        return $source
            ->materials()
            ->firstOrCreate([
                'feed_id' => $data['feed_id'],
            ], [
                'title' => $data['title'],
                'description' => $data['description'],
                'body' => $data['body'],
                'author' => $data['author'],
                'url' => $data['url'],
                'published_at' => $data['published_at'],
                'duration' => $data['duration'],
            ]);
    }
}
