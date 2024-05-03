<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public function roles() {
        return $this->hasMany(Role::class);
    }
    public function users() {
        return $this->hasMany(User::class);
    }
    public function terms() {
        return $this->hasMany(Term::class);
    }
    public function companies() {
        return $this->hasMany(Company::class);
    }
    public function categories() {
        return $this->hasMany(Category::class);
    }
    public function disclosed_account_lists() {
        return $this->hasMany(DisclosedAccountList::class);
    }
    public function accounts() {
        return $this->hasManyThrough(Account::class, Category::class);
    }
    public function currencies() {
        return $this->hasMany(Currency::class);
    }
    public function disclosed_business_lists() {
        return $this->hasMany(DisclosedBusinessList::class);
    }
    public function journal_categories() {
        return $this->hasMany(JournalCategory::class);
    }
    public function businesses() {
        return $this->hasManyThrough(Business::class, DisclosedBusinessList::class);
    }
    public function details() {
        return $this->hasManyThrough(Detail::class, JournalCategory::class);
    }
}
