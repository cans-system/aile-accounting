<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [1, '奥村 大地', 'okumuradaichi2007@gmail.com', 1, 1]
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'id' => $user[0],
                'name' => $user[1],
                'email' => $user[2],
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'role_id' => $user[3],
                'client_id' => $user[4],
            ]);
        }
    }
}
