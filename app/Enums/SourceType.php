<?php

namespace App\Enums;

enum SourceType: string {
    case Youtube = 'youtube';
    case Article = 'article';
    case Podcast = 'podcast';
}
