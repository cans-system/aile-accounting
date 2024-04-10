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
}
