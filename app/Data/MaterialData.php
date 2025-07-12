<?php

declare(strict_types=1);

namespace App\Data;

use App\Enums\SourceType;
use Illuminate\Support\Carbon;
use SimplePie\Item;

class MaterialData
{
    public static $classes = [
        'article' => ArticleMaterialData::class,
        'podcast' => PodcastMaterialData::class,
        'youtube' => YoutubeMaterialData::class,
    ];

    public function __construct(
        public string $title,
        public string $url,
        public Carbon $publishedAt,
        public ?string $description,
        public ?string $body,
        public ?string $author,
        public ?string $imageUrl,
        public bool $isDisplayed = true,
        public ?int $duration = null,
        public ?string $feedId = null,

    ) {}

    public static function create(SourceType $sourceType, Item $item): static
    {
        $class = static::$classes[$sourceType->value];

        return call_user_func([$class, 'from'], $item);
    }

    public static function fromRequest(array $data): static
    {
        return new static(
            title: $data['title'],
            description: $data['description'],
            body: $data['body'],
            author: $data['author'],
            url: $data['url'],
            publishedAt: Carbon::parse($data['published_at'])->timezone(config('app.timezone')),
            imageUrl: $data['image_url'],
            duration: isset($data['duration']) ? (int) $data['duration'] : null,
            isDisplayed: $data['is_displayed'],
        );
    }
}
