<?php

namespace App\Models;

use App\Enums\TermGroup;
use App\Enums\TermPeriod;
use App\Enums\TermType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;

    protected $casts = [
        'group' => TermGroup::class,
        'type' => TermType::class,
        'period' => TermPeriod::class,
    ];

    public function scopes() {
        return $this->hasMany(Scope::class);
    }

    public function rates() {
        return $this->hasMany(Rate::class);
    }
}
