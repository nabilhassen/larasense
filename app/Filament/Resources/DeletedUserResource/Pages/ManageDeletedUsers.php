<?php
namespace App\Filament\Resources\DeletedUserResource\Pages;

use App\Filament\Resources\DeletedUserResource;
use Filament\Resources\Pages\ManageRecords;

class ManageDeletedUsers extends ManageRecords
{
    protected static string $resource = DeletedUserResource::class;
}
