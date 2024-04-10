<?php

namespace Database\Seeders;

use App\Models\User;
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
        $collection = [
            [1, '奥村 大地', 'okumura@example.com', 1]
        ];

        foreach ($collection as $item) {
            $user = new User();
            $user->id = $item[0];
            $user->name = $item[1];
            $user->email = $item[2];
            $user->email_verified_at = now();
            $user->password = Hash::make('password');
            $user->remember_token = Str::random(10);
            $user->role_id = $item[3];
            $user->client_id = 1;
            $user->save();
        }
    }
}
