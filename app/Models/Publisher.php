<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Publisher extends Model
{
    /** @use HasFactory<\Database\Factories\PublisherFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'is_tracked' => 'boolean',
            'is_displayed' => 'boolean',
        ];
    }

    public function sources(): HasMany
    {
        return $this->hasMany(Source::class);
    }

    public function materials(): HasManyThrough
    {
        return $this->hasManyThrough(Material::class, Source::class);
    }

    public function scopeTracked(Builder $query): void
    {
        $query->where('is_tracked', 1);
    }

    public function scopeNotTracked(Builder $query): void
    {
        $query->where('is_tracked', 0);
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
