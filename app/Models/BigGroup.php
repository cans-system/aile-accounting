<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BigGroup extends Model
{
    use HasFactory;

    public function small_groups() {
        return $this->hasMany(SmallGroup::class);
    }
}
