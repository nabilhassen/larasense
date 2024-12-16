<?php

namespace App\Filament\Resources\MaterialResource\Pages;

use App\Actions\CreateMaterial;
use App\Data\MaterialData;
use App\Filament\Resources\MaterialResource;
use App\Models\Material;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageMaterials extends ManageRecords
{
    protected static string $resource = MaterialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->using(function (array $data, CreateMaterial $createMaterial): Material {
                    $materialData = MaterialData::fromRequest($data);

                    return $createMaterial->handle($data['source_id'], $materialData);
                }),
        ];
    }
}
