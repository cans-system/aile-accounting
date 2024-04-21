<?php

namespace App\Models;

use App\Enums\Statement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $casts = [
        'statement' => Statement::class
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
}
