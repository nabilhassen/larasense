<?php

declare(strict_types=1);

namespace App\Filament\Resources\SourceSuggestionResource\Pages;

use App\Filament\Resources\SourceSuggestionResource;
use Filament\Resources\Pages\ManageRecords;

class ManageSourceSuggestions extends ManageRecords
{
    protected static string $resource = SourceSuggestionResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
