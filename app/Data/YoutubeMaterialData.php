<?php

declare(strict_types=1);

namespace App\Data;

use Illuminate\Support\Carbon;
use SimplePie\Item;

class YoutubeMaterialData extends MaterialData
{
    public static function from(Item $item): static
    {
        return new static(
            title: $item->get_title(),
            description: $item->get_enclosure()?->get_description() ?? $item->get_description(),
            body: $item->get_content(),
            author: $item->get_author()?->get_name(),
            url: $item->get_link(),
            publishedAt: Carbon::parse($item->get_date())->timezone(config('app.timezone')),
            feedId: $item->get_id(true),
            imageUrl: $item->get_enclosure()?->get_thumbnail(),
            duration: $item->get_enclosure()?->get_duration()
        );
    }
}
