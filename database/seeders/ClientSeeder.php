<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = [
            [1, '株式会社オクムラ']
        ];

        foreach ($clients as $client) {
            DB::table('clients')->insert([
                'id' => $client[0],
                'title' => $client[1]
            ]);
        }
    }
}
