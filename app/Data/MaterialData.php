<?php

namespace App\Data;

use App\Enums\SourceType;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use shweshi\OpenGraph\Facades\OpenGraphFacade;
use SimplePie\Item;
use SimplePie\SimplePie;

class MaterialData
{
    public function __construct(
        public string $title,
        public ?string $description,
        public ?string $body,
        public ?string $author,
        public string $url,
        public Carbon $publishedAt,
        public string $id,
        public ?string $imageUrl,
        public int $duration = 0,

    ) {}

    public static function create(SourceType $sourceType, Item $item): static
    {
        $method = str('from')->append($sourceType->name)->toString();

        return call_user_func([static::class, $method], $item);
    }

    public static function fromArticle(Item $item): static
    {
        $openGraphData = OpenGraphFacade::fetch($item->get_link(), true);

        $openGraphData = Arr::where($openGraphData, fn($value, $key) => filled($value));

        return new static(
            $item->get_title(),
            $openGraphData['description'] ?? $openGraphData['og:description'] ?? $item->get_description(),
            $item->get_content(),
            $item->get_author(),
            $item->get_link(),
            Carbon::parse($item->get_date()),
            $item->get_id(true),
            $openGraphData['image:secure_url'] ?? $openGraphData['image'] ?? $openGraphData['twitter:image'] ?? $item->get_enclosure()->get_thumbnail(),
            $item->get_enclosure()->get_duration() ?? 0
        );
    }

    public static function fromYoutube(Item $item): static
    {
        return new static(
            $item->get_title(),
            $item->get_enclosure()->get_description() ?? $item->get_description(),
            $item->get_content(),
            $item->get_author(),
            $item->get_link(),
            Carbon::parse($item->get_date()),
            $item->get_id(true),
            $item->get_enclosure()->get_thumbnail(),
            $item->get_enclosure()->get_duration() ?? 0
        );
    }

    public static function fromPodcast(Item $item): static
    {
        return new static(
            $item->get_title(),
            $item->get_description(),
            $item->get_content(),
            static::getItunesTags($item, 'author')[0]['data'] ?? $item->get_author(),
            $item->get_enclosure()->get_link() ?? $item->get_link(),
            Carbon::parse($item->get_date()),
            $item->get_id(true),
            static::getItunesTags($item, 'image')[0]['attribs']['']['href'] ?? $item->get_enclosure()->get_thumbnail(),
            static::getItunesTags($item, 'duration')[0]['data'] ?? $item->get_enclosure()->get_duration() ?? 0
        );
    }

    // public static function fromRequest(array $data): static
    // {
    //     return new static(
    //         $data['source_id'],
    //         $data['title'],
    //         $data['description'],
    //         $data['body'],
    //         $data['duration'],
    //         $data['author'],
    //         $data['is_displayed'],
    //         $data['url'],
    //         $data['image_url'],
    //         $data['published_at'],
    //     );
    // }

    protected static function getItunesTags(Item $item, string $tag): array
    {
        return $item->get_item_tags(SimplePie::NAMESPACE_ITUNES, $tag) ?? [];
    }
}
