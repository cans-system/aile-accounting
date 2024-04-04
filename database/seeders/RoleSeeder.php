<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [1, 'システム管理者', 1],
            [2, '親会社担当者', 1],
            [3, '親会社承認者', 1],
            [4, '子会社担当者', 1],
            [5, '子会社承認者', 1],
            [6, '監査', 1]
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert([
                'id' => $role[0],
                'title' => $role[1],
                'client_id' => $role[2]
            ]);
        }
    }
}
