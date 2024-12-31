<?php

namespace App\Models;

use App\Enums\SourceType;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Maize\Markable\Markable;
use Maize\Markable\Models\Bookmark;
use Maize\Markable\Models\Like;
use Maize\Markable\Models\Reaction;

class Material extends Model
{
    /** @use HasFactory<\Database\Factories\MaterialFactory> */
    use HasFactory, Markable;

    protected $appends = [
        'thumbnail',
    ];

    protected static $marks = [
        Like::class,
        Bookmark::class,
        Reaction::class,
    ];

    public const DISLIKE_REACTION = 'material.dislike';

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

    public function thumbnail(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (blank($this->image_url)) {
                    return str($this->loadMissing('source.publisher')->source->publisher->logo)->prepend('storage/');
                }

                if ($this->isYoutube() || $this->isPodcast()) {
                    return $this->image_url;
                }

                return str($this->image_url)->prepend('storage/');
            }
        )->shouldCache();
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

    public function scopeSlug(Builder $query, string $slug): void
    {
        $query->where('slug', $slug);
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

    public static function feedQuery(): Builder
    {
        return static::query()
            ->displayed()
            ->latest('published_at')
            ->select([
                'id',
                'source_id',
                'title',
                'description',
                'body',
                'slug',
                'url',
                'image_url',
                'published_at',
            ])
            ->with([
                'source:id,publisher_id,type' => [
                    'publisher:id,name,logo',
                ],
            ])
            ->withExists([
                'likes',
                'bookmarks',
                'reactions AS dislikes_exists' => function (Builder $query) {
                    $query->where('value', static::DISLIKE_REACTION);
                },
            ])
            ->withCount(['likes']);
    }
}
