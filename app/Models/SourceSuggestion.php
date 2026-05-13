<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\SourceSuggestionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SourceSuggestion extends Model
{
    /** @use HasFactory<SourceSuggestionFactory> */
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
