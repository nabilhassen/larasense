<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Material;
use App\Models\Publisher;
use App\Models\Source;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Publisher::factory()
            ->count(5)
            ->has(
                Source::factory(2)
                    ->has(Material::factory()->count(5))
            )
            ->create();
    }
}
