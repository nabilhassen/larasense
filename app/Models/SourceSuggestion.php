<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SourceSuggestion extends Model
{
    /** @use HasFactory<\Database\Factories\SourceSuggestionFactory> */
    use HasFactory;

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
