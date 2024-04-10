<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Business;
use App\Models\Client;
use App\Models\Company;
use App\Models\Currency;
use App\Models\DisclosedBusinessList;
use App\Models\Role;
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
            new Role(['id' => 1, 'title' => 'システム管理者']),
            new Role(['id' => 2, 'title' => '親会社担当者']),
            new Role(['id' => 3, 'title' => '親会社承認者']),
            new Role(['id' => 4, 'title' => '子会社担当者']),
            new Role(['id' => 5, 'title' => '子会社承認者']),
            new Role(['id' => 6, 'title' => '監査'])
        ]);

        $client->users()->save(new User([
            'name' => '奥村 大地',
            'email' => 'okumura@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'role_id' => 1
        ]));
        
        $client->terms()->save(new Term([
            'group' => '実績',
            'month' => '2024-04',
            'type' => '実績',
            'period' => '月次'
        ]));

        $client->currencies()->save(new Currency(['title' => '日本円']));

        $client->companies()->save(new Company(['title' => '奥村建設', 'fiscal_month' => 3, 'currency_id' => 1]));
        
        $disclosed_business_list = $client->disclosed_business_lists()->save(
            new DisclosedBusinessList(['title' => 'AAセグメント', 'enabled' => true])
        );
        
        $disclosed_business_list->businesses()->save(
            new Business(['title' => 'A1セグメント', 'enabled' => true])
        );
    }
}
