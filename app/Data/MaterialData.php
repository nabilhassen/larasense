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
        $method = str('from')->append($sourceType->name)->toString();

        return call_user_func([static::class, $method], $item);
    }

    public static function fromArticle(Item $item): static
    {
        $openGraphData = OpenGraphFacade::fetch($item->get_link(), true);

        $openGraphData = Arr::where($openGraphData, fn($value, $key) => filled($value));

        return new static(
            title: $item->get_title(),
            description: $openGraphData['description'] ?? $openGraphData['og:description'] ?? $item->get_description(),
            body: $item->get_content(),
            author: $item->get_author(),
            url: $item->get_link(),
            publishedAt: Carbon::parse($item->get_date())->timezone(config('app.timezone')),
            feedId: $item->get_id(true),
            imageUrl: $openGraphData['image:secure_url'] ?? $openGraphData['image'] ?? $openGraphData['twitter:image'] ?? $item->get_enclosure()?->get_thumbnail() ?? str($item->get_content())->betweenFirst('img src="', '"')->toString(),
        );
    }

    public static function fromYoutube(Item $item): static
    {
        return new static(
            title: $item->get_title(),
            description: $item->get_enclosure()?->get_description() ?? $item->get_description(),
            body: $item->get_content(),
            author: $item->get_author(),
            url: $item->get_link(),
            publishedAt: Carbon::parse($item->get_date())->timezone(config('app.timezone')),
            feedId: $item->get_id(true),
            imageUrl: $item->get_enclosure()?->get_thumbnail(),
            duration: $item->get_enclosure()?->get_duration()
        );
    }

    public static function fromPodcast(Item $item): static
    {
        $duration = static::getItunesTags($item, 'duration')[0]['data'] ?? $item->get_enclosure()?->get_duration();

        return new static(
            title: $item->get_title(),
            description: $item->get_description(),
            body: $item->get_content(),
            author: static::getItunesTags($item, 'author')[0]['data'] ?? $item->get_author(),
            url: $item->get_enclosure()?->get_link() ?? $item->get_link(),
            publishedAt: Carbon::parse($item->get_date())->timezone(config('app.timezone')),
            feedId: $item->get_id(true),
            imageUrl: static::getItunesTags($item, 'image')[0]['attribs']['']['href'] ?? $item->get_enclosure()?->get_thumbnail(),
            duration: is_int($duration) ? $duration : null
        );
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
            duration: $data['duration'],
            isDisplayed: $data['is_displayed'],
        );
    }

    protected static function getItunesTags(Item $item, string $tag): array
    {
        return $item->get_item_tags(SimplePie::NAMESPACE_ITUNES, $tag) ?? [];
    }
}
