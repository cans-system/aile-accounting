<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DisclosedBusinessList extends Model
{
    use HasFactory;

    public function businesses(): HasMany {
        return $this->hasMany(Business::class);
    }
}
