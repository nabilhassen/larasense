<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\Publisher;
use App\Models\Source;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Publisher::factory(5)
            ->has(
                Source::factory(2)
                    ->has(Material::factory(5))
            )
            ->create();
    }
}
