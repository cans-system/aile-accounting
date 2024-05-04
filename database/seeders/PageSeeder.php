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
            ['マスタ設定', 'master', 0, [
                ['会計期間マスタ', [
                    ['会計期間マスタ', 'terms', true]
                ]],
                ['会社マスタ', [
                    ['会社マスタ', 'companies', true],
                    ['連結範囲マスタ', 'scopes', true]
                ]],
                ['勘定科目関連マスタ', [
                    ['科目分類マスタ', 'categories', true],
                    ['勘定科目マスタ', 'accounts', true],
                    ['開示科目マスタ', 'disclosed_account_lists', true],
                    ['科目集計設定マスタ', 'terms', false]
                ]],
                ['セグメント関連マスタ', [
                    ['事業セグメントマスタ', 'businesses', true],
                    ['開示セグメントマスタ', 'disclosed_business_lists', true],
                    ['会社-事業 セグメント紐づけマスタ', 'company_business', true],
                    ['セグメント報告集計対象マスタ', 'terms', false]
                ]],
                ['外貨換算関連マスタ', [
                    ['通貨マスタ', 'currencies', true],
                    ['換算レート設定マスタ', 'rates', true],
                    ['外貨修正仕訳分類マスタ', 'terms', false]
                ]],
                ['連結仕訳関連マスタ', [
                    ['連結仕訳分類マスタ', 'journal_categories', true],
                    ['連結仕訳小分類マスタ', 'journal_subcategories', true],
                    ['自動仕訳設定マスタ', 'terms', false],
                    ['持分比率設定マスタ', 'terms', false],
                    ['法定実効税率マスタ', 'terms', false],
                    ['内部取引グループマスタ', 'terms', false],
                    ['ネット処理設定マスタ', 'terms', false]
                ]],
            ]],
            ['連結パッケージ', 'package', -100, [
                ['個別財務諸表', [
                    ['貸借対照表', 'bs', true],
                    ['損益計算書', 'pl', true],
                    ['包括利益計算書', 'ci', true],
                    ['株主資本等変動計算書', 'cn', true]
                ]],
                ['その他情報', [
                    ['その他情報', '', false]
                ]],
                ['承認', [
                    ['承認', 'approval', false]
                ]],
            ]],
            ['外貨換算', 'conversion', -200, [
                
            ]],
            ['連結仕訳', 'journal', -300, [
                ['連結仕訳入力', [
                    ['連結仕訳入力・承認', 'details_edit', true]
                ]],
                ['連結仕訳帳', [
                    ['連結仕訳帳', 'details', true]
                ]],
                ['連結仕訳別残高確認', [
                    ['連結仕訳別残高確認', 'balance', true]
                ]],
            ]],
            ['連結精算表', 'worksheet', -400, [
                ['連結精算表', [
                    ['サマリー', 'summary', false],
                    ['仕訳分類別', '', false],
                    ['残高推移', '', false]
                ]],
                ['会社別連結精算表', [
                    ['会社別精算表', 'companies', false]
                ]],
                ['連結総勘定元帳', [
                    ['連結総勘定元帳', '', false]
                ]],
            ]],
            ['連結財務諸表', 'statement', -500, [
                
            ]],
            ['注記情報', 'info', -600, [
                
            ]],
            ['管理', 'management', -700, [
                ['ユーザー・ロール管理', [
                    ['ユーザー管理', 'users', true],
                    ['ロール管理', 'roles', true]
                ]],
                ['締め処理・データ繰越', [
                    ['締め処理', 'closing', false],
                    ['データ繰越', 'carryover', false]
                ]]
            ]]
        ];

        foreach ($pages as $item) {
            $bigGroup = new BigGroup(['title' => $item[0], 'path' => $item[1], 'left' => $item[2]]);
            $bigGroup->save();
            foreach ($item[3] as $item) {
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
