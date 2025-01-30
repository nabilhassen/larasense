<?php

namespace App\Models;

use App\Enums\DigestFrequency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Digest extends Model
{
    /** @use HasFactory<\Database\Factories\DigestFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'frequency' => DigestFrequency::class,
        ];
    }
}
