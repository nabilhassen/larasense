<?php

namespace App\Transforms;

use Illuminate\Support\Carbon;
use SimplePie\Item;

class BaseTransformer
{
    public function __construct(public Item $item)
    {}

    public static function from(Item $item): static
    {
        return new static($item);
    }

    public function transform(): array
    {
        return [
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'body' => $this->getContent(),
            'author' => $this->getAuthor(),
            'url' => $this->getLink(),
            'published_at' => $this->getDate(),
            'feed_id' => $this->getId(),
            'image_url' => $this->getImageUrl(),
            'duration' => $this->getDuration(),
        ];
    }

    public function getTitle(): string
    {
        return $this->item->get_title();
    }

    public function getDescription(): string
    {
        return $this->item->get_description();
    }

    public function getContent(): string
    {
        return $this->item->get_content();
    }

    public function getAuthor(): string
    {
        return $this->item->get_author()->get_name();
    }

    public function getLink(): string
    {
        return $this->item->get_link();
    }

    public function getDate(): string
    {
        return Carbon::parse($this->item->get_date());
    }

    public function getId(): string
    {
        return $this->item->get_id(true);
    }

    public function getDuration(): int
    {
        return $this->item->get_enclosure()->get_duration() ?? 0;
    }

    public function getImageUrl(): ?string
    {
        return $this->item->get_enclosure()->get_thumbnail();
    }
}
