<?php

namespace App\Transforms;

use App\Transforms\BaseTransformer;
use Illuminate\Support\Arr;
use shweshi\OpenGraph\Facades\OpenGraphFacade;
use SimplePie\Item;

class ArticleTransformer extends BaseTransformer
{
    protected array $openGraphData;

    public function __construct(Item $item)
    {
        parent::__construct($item);

        $this->initOpenGraph();
    }

    public function initOpenGraph(): void
    {
        $this->openGraphData = OpenGraphFacade::fetch($this->getLink(), true);

        $this->openGraphData = Arr::where($this->openGraphData, fn($value, $key) => filled($value));
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
