<?php

namespace App\Transforms;

use SimplePie\SimplePie;

class PodcastTransformer extends BaseTransformer
{
    public function getImageUrl(): ?string
    {
        return $this->getItunesTags('image')[0]['attribs']['']['href'] ?? null;
    }

    public function getLink(): string
    {
        return $this->item->get_enclosure()->get_link();
    }

    public function getItunesTags(string $tag): array
    {
        return $this
            ->item
            ->get_item_tags(SimplePie::NAMESPACE_ITUNES, $tag) ?? [];
    }

    public function getDuration(): int
    {
        return $this->getItunesTags('duration')[0]['data'] ?? 0;
    }

    public function getAuthor(): ?string
    {
        return $this->getItunesTags('author')[0]['data'] ?? parent::getAuthor();
    }
}
