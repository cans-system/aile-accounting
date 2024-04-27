<?php

namespace App\Models;

use App\Enums\ScopeRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scope extends Model
{
    use HasFactory;

    protected $casts = [
        'relation' => ScopeRelation::class
    ];

    public function company() {
        return $this->belongsTo(Company::class);
    }
}
