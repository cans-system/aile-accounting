<?php

namespace Database\Seeders;

use App\Models\DisclosedBusinessList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DisclosedBusinessListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $collection = [
            [1, 'AAセグメント', true]
        ];

        foreach ($collection as $item) {
            $business = new DisclosedBusinessList();
            $business->id = $item[0];
            $business->title = $item[1];
            $business->enabled = $item[2];
            $business->client_id = 1;
            $business->save();
        }
    }
}
