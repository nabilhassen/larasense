<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Source;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Material>
 */
class MaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'source_id' => Source::factory(),
            'feed_id' => Str::random(),
            'title' => $this->faker->words(asText: true),
            'description' => $this->faker->sentence(),
            'body' => $this->faker->paragraph(),
            'author' => $this->faker->name(),
            'is_displayed' => 1,
            'url' => $this->faker->unique()->url(),
            'duration' => $this->faker->randomNumber(6),
            'image_url' => 'https://picsum.photos/600/480',
            'published_at' => now(),
        ];
    }
}
