<?php

namespace Database\Factories;

use App\Enums\DigestFrequency;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Digest>
 */
class DigestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'digest' => Arr::random(array_column(DigestFrequency::cases(), 'value')),
        ];
    }
}
