<?php

namespace Database\Seeders;

use App\Models\BigGroup;
use App\Models\Page;
use App\Models\SmallGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            ['マスタ設定', 'master', [
                ['会計期間マスタ', [
                    ['会計期間マスタ', 'terms', true]
                ]],
                ['会社マスタ', [
                    ['会社マスタ', 'companies', true],
                    ['連結範囲マスタ', 'scopes', false]
                ]],
                ['勘定科目関連マスタ', [
                    ['科目分類マスタ', 'categories', false],
                    ['勘定科目マスタ', 'accounts', false],
                    ['開示科目マスタ', 'disclosed_account_lists', false],
                    ['科目集計設定マスタ', 'terms', false]
                ]],
                ['セグメント関連マスタ', [
                    ['事業セグメントマスタ', 'businesses', true],
                    ['開示セグメントマスタ', 'disclosed_business_lists', true],
                    ['会社-事業 セグメント紐づけマスタ', 'company_business', false],
                    ['セグメント報告集計対象マスタ', 'terms', false]
                ]],
                ['外貨換算関連マスタ', [
                    ['通貨マスタ', 'currencies', true],
                    ['換算レート設定マスタ', 'rates', false],
                    ['外貨修正仕訳分類マスタ', 'terms', false]
                ]],
                ['連結仕訳関連マスタ', [
                    ['連結仕訳分類マスタ', 'terms', false],
                    ['自動仕訳設定マスタ', 'terms', false],
                    ['持分比率設定マスタ', 'terms', false],
                    ['法定実効税率マスタ', 'terms', false],
                    ['内部取引グループマスタ', 'terms', false],
                    ['ネット処理設定マスタ', 'terms', false]
                ]],
            ]],
            ['連結パッケージ', 'package', [
                
            ]],
            ['外貨換算', 'conversion', [
                
            ]],
            ['連結仕訳', 'journal', [
                
            ]],
            ['連結精算表', 'worksheet', [
                
            ]],
            ['連結財務諸表', 'statement', [
                
            ]],
            ['注記情報', 'info', [
                
            ]],
            ['管理', 'management', [
                ['ユーザー・ロール管理', [
                    ['ユーザー管理', 'users', true],
                    ['ロール管理', 'roles', false]
                ]]
            ]]
        ];

        foreach ($pages as $item) {
            $bigGroup = new BigGroup(['title' => $item[0], 'path' => $item[1]]);
            $bigGroup->save();
            foreach ($item[2] as $item) {
                $smallGroup = $bigGroup->small_groups()->save(
                    new SmallGroup(['title' => $item[0]])
                );
                foreach ($item[1] as $item)
                $smallGroup->pages()->save(
                    new Page(['title' => $item[0], 'path' => $item[1], 'enabled' => $item[2]])
                );
            }
        }
    }
}
