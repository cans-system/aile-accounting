<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Detail extends Model
{
    use HasFactory;

    public function business(): BelongsTo {
        return $this->belongsTo(Company::class);
    }

    public function target_business(): BelongsTo {
        return $this->belongsTo(Company::class, 'target_business_id');
    }
}
