<?php

namespace App\Actions;

use App\Enums\SourceType;
use App\Transforms\ArticleTransformer;
use App\Transforms\PodcastTransformer;
use App\Transforms\YoutubeTransformer;
use SimplePie\Item;

class TransformItem
{
    public function handle(SourceType $type, Item $item): array
    {
        return match ($type->value) {
            'article' => ArticleTransformer::from($item)->transform(),
            'podcast' => PodcastTransformer::from($item)->transform(),
            'youtube' => YoutubeTransformer::from($item)->transform(),
        };
    }
}
