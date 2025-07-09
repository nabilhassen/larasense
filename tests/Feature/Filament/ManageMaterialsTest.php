<?php

declare(strict_types=1);

use App\Filament\Resources\MaterialResource\Pages\ManageMaterials;
use App\Models\Material;
use Filament\Actions\CreateAction;
use Illuminate\Support\Facades\Queue;
use Livewire\Livewire;

test('can create material from filament admin panel', function () {
    Queue::fake();
    $newData = Material::factory()->make();

    Livewire::test(ManageMaterials::class)
        ->callAction(CreateAction::class, $newData->toArray())
        ->assertHasNoActionErrors();

    $this->assertDatabaseHas(Material::class, [
        'url' => $newData->url,
    ]);
});
