<?php

namespace App\Models;

use App\Enums\SourceType;
use Illuminate\Contracts\Database\Eloquent\Builder;
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
            'published_at' => 'datetime',
            'duration' => 'integer',
        ];
    }

    public function source(): BelongsTo
    {
        return $this->belongsTo(Source::class);
    }

    public function scopeDisplayed(Builder $query): void
    {
        $query
            ->where('is_displayed', 1)
            ->whereHas('source', fn(Builder $q) => $q->displayed());
    }

    public function scopeNotDisplayed(Builder $query): void
    {
        $query->where('is_displayed', 0);
    }

    public function isArticle(): bool
    {
        return $this->source->type === SourceType::Article;
    }

    public function isYoutube(): bool
    {
        return $this->source->type === SourceType::Youtube;
    }

    public function isPodcast(): bool
    {
        return $this->source->type === SourceType::Podcast;
    }
}
