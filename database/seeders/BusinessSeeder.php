<?php

namespace Database\Seeders;

use App\Models\Business;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $collection = [
            [1, 'A1セグメント', true]
        ];

        foreach ($collection as $item) {
            $list = new Business();
            $list->id = $item[0];
            $list->title = $item[1];
            $list->enabled = $item[2];
            $list->disclosed_business_list_id = 1;
            $list->save();
        }
    }
}
