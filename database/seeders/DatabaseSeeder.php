<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\ScopeRelation;
use App\Enums\Statement;
use App\Models\Account;
use App\Models\Business;
use App\Models\Category;
use App\Models\Client;
use App\Models\Company;
use App\Models\Currency;
use App\Models\DisclosedAccountList;
use App\Models\DisclosedBusinessList;
use App\Models\Rate;
use App\Models\Role;
use App\Models\Scope;
use App\Models\Term;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PageSeeder::class
        ]);

        $client = new Client();
        $client->title = '株式会社オクムラ';
        $client->location = '名古屋';
        $client->pic_name = '高井十蔵';
        $client->pic_contact = 'juzotakai@example.com';
        $client->save();

        $client->roles()->saveMany([
            $role = new Role(['title' => 'システム管理者', 'master' => 'writable', 'package' => 'writable', 'settlement' => 'writable', 'users' => 'writable', 'closing' => 'writable', 'carryover' => 'writable']),
            new Role(['title' => '親会社担当者', 'master' => 'writable', 'package' => 'writable', 'settlement' => 'writable', 'users' => 'writable', 'closing' => 'writable', 'carryover' => 'writable']),
            new Role(['title' => '親会社承認者', 'master' => 'writable', 'package' => 'approveonly', 'settlement' => 'approveonly', 'users' => 'approveonly', 'closing' => 'writable', 'carryover' => 'writable']),
            new Role(['title' => '子会社担当者', 'package' => 'writable']),
            new Role(['title' => '子会社承認者', 'package' => 'approveonly']),
            new Role(['title' => '監査', 'master' => 'readonly', 'package' => 'readonly', 'settlement' => 'readonly', 'users' => 'readonly'])
        ]);

        $client->users()->save(new User([
            'name' => '奥村 大地',
            'email' => 'okumura@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'role_id' => $role->id
        ]));

        $client->disclosed_business_lists()->saveMany([
            $disclosed_business_list = new DisclosedBusinessList(['title' => 'AAセグメント', 'enabled' => true]),
            new DisclosedBusinessList(['title' => 'BBセグメント', 'enabled' => true])
        ]);
        
        $disclosed_business_list->businesses()->saveMany([
            $business = new Business(['title' => 'A1セグメント', 'enabled' => true]),
            new Business(['title' => 'A2セグメント', 'enabled' => true])
        ]);

        $client->categories()->saveMany([
            $category = new Category(['title' => '流動資産', 'enabled' => true]),
            new Category(['title' => '固定資産', 'enabled' => true]),
            new Category(['title' => '流動負債', 'enabled' => true]),
            new Category(['title' => '固定負債', 'enabled' => true]),
            new Category(['title' => '純資産', 'enabled' => true]),
            new Category(['title' => '売上高', 'enabled' => true])
        ]);

        $client->disclosed_account_lists()->saveMany([
            $disclosed_account_list = new DisclosedAccountList(['title' => '現金及び預金']),
            new DisclosedAccountList(['title' => '売掛金']),
            new DisclosedAccountList(['title' => '商品']),
            new DisclosedAccountList(['title' => '流動資産']),
            new DisclosedAccountList(['title' => '建物']),
            new DisclosedAccountList(['title' => '買掛金']),
            new DisclosedAccountList(['title' => '長期借入金']),
            new DisclosedAccountList(['title' => '資本金'])
        ]);

        $category->accounts()->saveMany([
            $account = new Account([
                'title' => '現金',
                'title_en' => 'cash',
                'detail_summary' => '明細科目',
                'statement' => Statement::BS,
                'dr_cr' => '借方',
                'year_disclosed_account_list_id' => $disclosed_account_list->id,
                'quarter_disclosed_account_list_id' => $disclosed_account_list->id,
                'conversion' => '期末日レート',
                'fctr_account_id' => null,
                'enabled' => true
            ]),
        ]);
        
        $client->terms()->saveMany([
            $term = new Term(['group' => '実績', 'month' => '2024-04', 'type' => '実績', 'period' => '月次']),
            new Term(['group' => '実績', 'month' => '2024-05', 'type' => '実績', 'period' => '月次'])
        ]);

        $client->currencies()->saveMany([
            new Currency(['title' => '日本円']),
            $currency = new Currency(['title' => 'USドル'])
        ]);

        $term->rates()->saveMany([
            new Rate(['currency_id' => $currency->id, 'last_day_rate' => 150.23, 'average_rate' => 147.82]),
        ]);
        
        $client->companies()->saveMany([
            $company = new Company(['title' => '奥村建設', 'fiscal_month' => 3, 'currency_id' => $currency->id, 'business_id' => $business->id]),
            $company2 = new Company(['title' => '奥村商事', 'fiscal_month' => 12, 'currency_id' => $currency->id, 'business_id' => $business->id])
        ]);

        $term->scopes()->saveMany([
            new Scope(['company_id' => $company->id, 'relation' => ScopeRelation::PARENT]),
            new Scope(['company_id' => $company2->id, 'relation' => ScopeRelation::EQUITY_METHOD_AFFILIATE])
        ]);
    }
}
