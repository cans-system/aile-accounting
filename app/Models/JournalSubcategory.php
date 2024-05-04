<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JournalSubcategory extends Model
{
    use HasFactory;

    public function journal_category(): BelongsTo {
        return $this->belongsTo(JournalCategory::class);
    }
}
