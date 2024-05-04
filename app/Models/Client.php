<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;

class Client extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

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
    public function journal_subcategories() {
        return $this->hasManyThrough(JournalSubcategory::class, JournalCategory::class);
    }
    public function businesses() {
        return $this->hasManyThrough(Business::class, DisclosedBusinessList::class);
    }
    public function cbs() {
        return $this->hasManyThrough(CompanyBusiness::class, Company::class);
    }
    public function jscs() {
        return $this->hasManyThrough(JournalSubcategory::class, JournalCategory::class);
    }
    public function details(): HasManyDeep {
        return $this->hasManyDeep(Detail::class, [JournalCategory::class, JournalSubcategory::class]);
    }
}
