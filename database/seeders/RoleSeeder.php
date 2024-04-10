<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colection = [
            [1, 'システム管理者'],
            [2, '親会社担当者'],
            [3, '親会社承認者'],
            [4, '子会社担当者'],
            [5, '子会社承認者'],
            [6, '監査']
        ];

        foreach ($colection as $item) {
            $role = new Role();
            $role->id = $item[0];
            $role->title = $item[1];
            $role->client_id = 1;
            $role->save();
        }
    }
}
