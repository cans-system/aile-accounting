<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            ['日本円', 1]
        ];

        foreach ($currencies as $currency) {
            DB::table('currencies')->insert([
                'title' => $currency[0],
                'client_id' => $currency[1]
            ]);
        }
    }
}
