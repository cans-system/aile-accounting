<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public function currency () {
        return $this->belongsTo(Currency::class);
    }

    public function businesses () {
        return $this->belongsToMany(Business::class, 'company_business');
    }

    public function default_business() {
        return $this->belongsTo(Business::class);
    }
}
