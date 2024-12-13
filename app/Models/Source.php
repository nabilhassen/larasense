<?php

namespace App\Models;

use App\Enums\SourceType;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Source extends Model
{
    /** @use HasFactory<\Database\Factories\SourceFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'is_tracked' => 'boolean',
            'is_displayed' => 'boolean',
            'type' => SourceType::class,
            'last_checked_at' => 'datetime',
        ];
    }

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class);
    }

    public function materials(): HasMany
    {
        return $this->hasMany(Material::class);
    }

    public function scopeTracked(Builder $query): void
    {
        $query->where('is_tracked', 1)->whereHas('publisher', fn(Builder $q) => $q->tracked());
    }

    public function scopeNotTracked(Builder $query): void
    {
        $query->where('is_tracked', 0);
    }

    public function scopeDisplayed(Builder $query): void
    {
        $query->where('is_displayed', 1)->whereHas('publisher', fn(Builder $q) => $q->displayed());
    }

    public function scopeNotDisplayed(Builder $query): void
    {
        $query->where('is_displayed', 0);
    }

    public function updateLastCheckedAt(): void
    {
        $this->last_checked_at = now();

        $this->save();
    }
}
