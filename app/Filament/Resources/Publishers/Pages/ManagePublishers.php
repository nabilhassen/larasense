<?php

declare(strict_types=1);

namespace App\Filament\Resources\Publishers\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\Publishers\PublisherResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePublishers extends ManageRecords
{
    protected static string $resource = PublisherResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
