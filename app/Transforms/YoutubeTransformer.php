<?php

namespace App\Transforms;

class YoutubeTransformer extends BaseTransformer
{
    public function getDescription(): ?string
    {
        return $this->item->get_enclosure()->get_description() ?? parent::getDescription();
    }
}
