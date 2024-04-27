<?php

namespace App\Models;

use App\Enums\CompanyRelation;
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

    public function business() {
        return $this->belongsTo(Business::class);
    }
}
