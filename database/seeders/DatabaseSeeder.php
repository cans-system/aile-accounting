<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Business;
use App\Models\Client;
use App\Models\Company;
use App\Models\Currency;
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
            new Scope(['company_id' => $company->id, 'relation' => '親会社']),
            new Scope(['company_id' => $company2->id, 'relation' => '持分法適用会社'])
        ]);
    }
}
