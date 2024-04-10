<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Client;
use App\Models\Currency;
use App\Models\Role;
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
        $client = new Client();
        $client->id = 1;
        $client->title = '株式会社オクムラ';
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

        $client->currencies()->save(new Currency(['title' => '日本円']));
        
        $client->disclosed_business_lists()->save(new Currency([
            'title' => 'AAセグメント',
            'enabled' => true
        ]));
        
        $client->businesses()->save(new Currency([
            'title' => 'A1セグメント',
            'enabled' => true
        ]));
    }
}
