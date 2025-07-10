<?php

declare(strict_types=1);

namespace App\Data;

use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use shweshi\OpenGraph\Facades\OpenGraphFacade;
use SimplePie\Item;

class ArticleMaterialData extends MaterialData
{
    public static function from(Item $item): static
    {
        $openGraph = static::getOpenGraph($item->get_link());

        return new static(
            title: $item->get_title(),
            description: static::getDescription($openGraph, $item),
            body: $item->get_content(),
            author: $item->get_author(),
            url: $item->get_link(),
            publishedAt: Carbon::parse($item->get_date())->timezone(config('app.timezone')),
            feedId: $item->get_id(true),
            imageUrl: static::getImageUrl($openGraph, $item),
        );
    }

    private static function getOpenGraph(string $link): mixed
    {
        return Arr::where(
            OpenGraphFacade::fetch($link, true),
            fn ($value, $key): bool => filled($value)
        );
    }

    private static function getDescription(mixed $openGraph, Item $item): string
    {
        return $openGraph['description'] ?? $openGraph['og:description'] ?? $item->get_description();
    }

    private static function getImageUrl(mixed $openGraph, Item $item): ?string
    {
        $imageUrl = $openGraph['image:secure_url'] ?? $openGraph['image'] ?? $openGraph['twitter:image'] ?? null;

        if (blank($imageUrl)) {
            $imageUrl = $item->get_enclosure()?->get_thumbnail() ?? str($item->get_content())->betweenFirst('img src="', '"')->toString();
        }

        return $imageUrl ?? null;
    }
}
