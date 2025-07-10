<?php

declare(strict_types=1);

namespace App\Data;

use Illuminate\Support\Carbon;
use SimplePie\Item;
use SimplePie\SimplePie;

class PodcastMaterialData extends MaterialData
{
    public static function from(Item $item): static
    {
        $duration = static::getItunesTags($item, 'duration')[0]['data'] ?? $item->get_enclosure()?->get_duration();

        return new static(
            title: $item->get_title(),
            description: $item->get_description(),
            body: $item->get_content(),
            author: static::getItunesTags($item, 'author')[0]['data'] ?? $item->get_author()?->get_name(),
            url: $item->get_enclosure()?->get_link() ?? $item->get_link(),
            publishedAt: Carbon::parse($item->get_date())->timezone(config('app.timezone')),
            feedId: $item->get_id(true),
            imageUrl: static::getItunesTags($item, 'image')[0]['attribs']['']['href'] ?? $item->get_enclosure()?->get_thumbnail(),
            duration: is_numeric($duration) ? (int) $duration : null
        );
    }

    private static function getItunesTags(Item $item, string $tag): array
    {
        return $item->get_item_tags(SimplePie::NAMESPACE_ITUNES, $tag) ?? [];
    }
}
