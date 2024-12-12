<?php

namespace App\Transforms;

use shweshi\OpenGraph\Facades\OpenGraphFacade;
use SimplePie\Item;

class ArticleTransformer extends BaseTransformer
{
    protected array $openGraphData;

    public function __construct(Item $item)
    {
        parent::__construct($item);

        $this->openGraphData = OpenGraphFacade::fetch($this->getLink());
    }

    public function getDescription(): string
    {
        return $this->openGraphData['description'] ?? $this->openGraphData['og:description'] ?? null;
    }

    public function getImageUrl(): ?string
    {
        return $this->openGraphData['image:secure_url'] ?? $this->openGraphData['image'] ?? $this->openGraphData['twitter:image'] ?? null;
    }
}
