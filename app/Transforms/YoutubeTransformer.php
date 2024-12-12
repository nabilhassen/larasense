<?php

namespace App\Transforms;

class YoutubeTransformer extends BaseTransformer
{
    public function getImageUrl(): ?string
    {
        return $this->item->get_enclosure()->get_thumbnail();
    }
}
