<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Material extends Model
{
    /** @use HasFactory<\Database\Factories\MaterialFactory> */
    use HasFactory;

    protected static function booted(): void
    {
        static::creating(function (Material $material) {
            $material->slug = Str::random();
        });
    }

    protected function casts(): array
    {
        return [
            'is_displayed' => 'boolean',
        ];
    }

    public function source(): BelongsTo
    {
        return $this->belongsTo(Source::class);
    }

    public function scopeDisplayed(Builder $query): void
    {
        $query->where('is_displayed', 1);
    }

    public function scopeNotDisplayed(Builder $query): void
    {
        $query->where('is_displayed', 0);
    }
}
