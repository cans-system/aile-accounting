<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyBusiness extends Model
{
    use HasFactory;

    protected $table = "company_business";

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function business() {
        return $this->belongsTo(Business::class);
    }
}
