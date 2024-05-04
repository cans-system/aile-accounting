<?php

namespace App\Models;

use App\Enums\Carryover;
use App\Enums\Modify;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JournalCategory extends Model
{
    use HasFactory;

    protected $casts = [
        'carryover' => Carryover::class,
        'modify' => Modify::class
    ];

    public function subcategories(): HasMany {
        return $this->hasMany(JournalSubcategory::class);
    }
}
