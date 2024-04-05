<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            ['マスタ設定', '/master', [
                ['会計期間マスタ', [
                    ['会計期間マスタ', '/terms']
                ]]
            ]],
            ['連結パッケージ', '/package', [
                
            ]],
            ['外貨換算', '/conversion', [
                
            ]],
            ['連結仕訳', '/journal', [
                
            ]],
            ['連結精算表', '/worksheet', [
                
            ]],
            ['連結財務諸表', '/statement', [
                
            ]],
            ['注記情報', '/info', [
                
            ]],
            ['管理', '/admin', [
                ['ユーザー・ロール管理', [
                    ['ユーザー管理', '/users'],
                    ['ロール管理', '/roles']
                ]]
            ]]
        ];

        foreach ($pages as $page) {
            DB::table('pages')->insert([
                'title' => $page[0],
                'path' => $page[1]
            ]);
            $page_id = DB::getPdo()->lastInsertId();
            foreach ($page[2] as $child) {
                DB::table('pages')->insert([
                    'title' => $child[0],
                    'parent_id' => $page_id
                ]);
                $child_id = DB::getPdo()->lastInsertId();
                foreach ($child[1] as $grandchild) {
                    DB::table('pages')->insert([
                        'title' => $grandchild[0],
                        'path' => $grandchild[1],
                        'parent_id' => $child_id
                    ]);
                }
            }
        }
    }
}
