<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\SourceType;
use App\Models\Publisher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Source>
 */
class SourceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'publisher_id' => Publisher::factory(),
            'url' => $this->faker->unique()->url(),
            'type' => collect(SourceType::cases())->pluck('value')->random(),
            'default_author' => $this->faker->name(),
            'is_tracked' => 1,
            'is_displayed' => 1,
            'last_checked_at' => now(),
        ];
    }
}
