<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    public function disclosed_business_list () {
        return $this->belongsTo(DisclosedBusinessList::class);
    }

    public function companies () {
        return $this->belongsToMany(Company::class, 'company_business');
    }
}
