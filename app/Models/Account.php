<?php

namespace App\Models;

use App\Enums\Conversion;
use App\Enums\DetailSummary;
use App\Enums\DrCr;
use App\Enums\Statement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    public function fcta_account(): BelongsTo {
        return $this->belongsTo(self::class, 'fcta_account_id', 'code');
    }
    public function carryover_account(): BelongsTo {
        return $this->belongsTo(self::class, 'carryover_account_id', 'code');
    }
    public function records(): HasMany {
        return $this->hasMany(Record::class);
    }
    public function record(int $term_id): Record|null {
        return $this->records()->where('term_id', $term_id)->first();
    }
}
