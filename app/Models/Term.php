<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;

    public function scopes() {
        return $this->hasMany(Scope::class);
    }

    public function rates() {
        return $this->hasMany(Rate::class);
    }
}
