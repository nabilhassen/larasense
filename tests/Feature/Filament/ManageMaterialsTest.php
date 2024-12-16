<?php

use Livewire\Livewire;
use App\Models\Material;
use Filament\Actions\CreateAction;
use App\Jobs\FetchMaterialImageJob;
use Illuminate\Support\Facades\Queue;
use App\Filament\Resources\MaterialResource\Pages\ManageMaterials;

test('can create material from filament admin panel', function () {
    Queue::fake(FetchMaterialImageJob::class);
    $newData = Material::factory()->make();

    Livewire::test(ManageMaterials::class)
        ->callAction(CreateAction::class, $newData->toArray())
        ->assertHasNoActionErrors();

    Queue::assertPushed(FetchMaterialImageJob::class, 1);
    $this->assertDatabaseHas(Material::class, [
        'url' => $newData->url,
    ]);
});
