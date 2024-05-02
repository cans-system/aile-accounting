<?php

namespace App\Models;

use App\Enums\Conversion;
use App\Enums\DetailSummary;
use App\Enums\DrCr;
use App\Enums\Statement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Account extends Model
{
    use HasFactory;

    protected $casts = [
        'statement' => Statement::class,
        'detail_summary' => DetailSummary::class,
        'dr_cr' => DrCr::class,
        'conversion' => Conversion::class,
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }
    public function yaer_disclosed_account_list() {
        return $this->belongsTo(DisclosedAccountList::class, 'year_disclosed_account_list_id');
    }
    public function quarter_disclosed_account_list() {
        return $this->belongsTo(DisclosedAccountList::class, 'quarter_disclosed_account_list_id');
    }
    public function statement(): Statement {
        return Statement::from($this->statement);
    }
    public function fctr_account(): BelongsTo {
        return $this->belongsTo(self::class, 'fctr_account_id');
    }
}
