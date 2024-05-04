<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Detail extends Model
{
    use HasFactory;

    public function company_business(): BelongsTo {
        return $this->belongsTo(CompanyBusiness::class);
    }

    public function target_company_business(): BelongsTo {
        return $this->belongsTo(CompanyBusiness::class, 'target_company_business_id');
    }

    public function account(): BelongsTo {
        return $this->belongsTo(Account::class);
    }
}
