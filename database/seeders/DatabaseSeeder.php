<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\Carryover;
use App\Enums\Conversion;
use App\Enums\DetailSummary;
use App\Enums\DrCr;
use App\Enums\Modify;
use App\Enums\Statement;
use App\Enums\TermGroup;
use App\Enums\TermPeriod;
use App\Enums\TermType;
use App\Models\Account;
use App\Models\Business;
use App\Models\Category;
use App\Models\Client;
use App\Models\Company;
use App\Models\Currency;
use App\Models\DisclosedAccountList;
use App\Models\DisclosedBusinessList;
use App\Models\JournalCategory;
use App\Models\JournalSubcategory;
use App\Models\Role;
use App\Models\Term;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PageSeeder::class
        ]);

        $client = new Client();
        $client->title = '株式会社オクムラ';
        $client->location = '名古屋';
        $client->pic_name = '高井十蔵';
        $client->pic_contact = 'juzotakai@example.com';
        $client->save();

        $client->roles()->saveMany([
            $role = new Role(['title' => 'システム管理者', 'master' => 'writable', 'package' => 'writable', 'settlement' => 'writable', 'users' => 'writable', 'closing' => 'writable', 'carryover' => 'writable']),
            new Role(['title' => '親会社担当者', 'master' => 'writable', 'package' => 'writable', 'settlement' => 'writable', 'users' => 'writable', 'closing' => 'writable', 'carryover' => 'writable']),
            new Role(['title' => '親会社承認者', 'master' => 'writable', 'package' => 'approveonly', 'settlement' => 'approveonly', 'users' => 'approveonly', 'closing' => 'writable', 'carryover' => 'writable']),
            new Role(['title' => '子会社担当者', 'package' => 'writable']),
            new Role(['title' => '子会社承認者', 'package' => 'approveonly']),
            new Role(['title' => '監査', 'master' => 'readonly', 'package' => 'readonly', 'settlement' => 'readonly', 'users' => 'readonly'])
        ]);

        $client->users()->save(new User([
            'name' => '奥村 大地',
            'email' => 'okumura@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'role_id' => $role->id
        ]));

        # 開示セグメント
        $client->disclosed_business_lists()->saveMany([
            $dbl1 = new DisclosedBusinessList(['title' => '販売', 'enabled' => true]),
            $dbl2 = new DisclosedBusinessList(['title' => 'サービス', 'enabled' => true]),
            $dbl3 = new DisclosedBusinessList(['title' => 'その他', 'enabled' => true]),
            $dbl4 = new DisclosedBusinessList(['title' => 'テスト', 'enabled' => true])
        ]);
        
        # 事業セグメント
        $dbl1->businesses()->saveMany([
            $b1 = new Business(['title' => '国内販売', 'enabled' => true]),
            $b2 = new Business(['title' => '海外販売', 'enabled' => true])
        ]);
        $dbl2->businesses()->saveMany([
            $b3 = new Business(['title' => '国内サービス', 'enabled' => true]),
            $b4 = new Business(['title' => '海外サービス', 'enabled' => true])
        ]);
        $dbl3->businesses()->saveMany([
            $b5 = new Business(['title' => '不動産', 'enabled' => true]),
            $b6 = new Business(['title' => '全社', 'enabled' => true])
        ]);
        $dbl4->businesses()->saveMany([
            $b7 = new Business(['title' => 'テスト', 'enabled' => true]),
        ]);
        
        $categories = [
            '流動資産' ,'固定資産' ,'資産計' ,'流動負債' ,'固定負債' ,'負債計' ,'純資産' ,'純資産計' ,'負債純資産計' ,'売上高',
            '売上原価' ,'売上総利益' ,'販管費' ,'営業利益' ,'営業外収益' ,'営業外費用' ,'経常利益' ,'特別利益' ,'特別損失',
            '税金等調整前当期純利益' ,'法人税等' ,'当期純利益' ,'非支配株主損益' ,'親会社株主に帰属する当期純利益','その他の包括利益',
            '資本金' ,'資本剰余金' ,'利益剰余金' ,'自己株式' ,'その他の包括利益累計額' ,'新株予約権' ,'非支配株主持分'
        ];
        $categories = array_map(fn ($title) => new Category(['title' => $title, 'enabled' => true]), $categories);
        $client->categories()->saveMany($categories);

        $dals = [
            '現金及び預金' ,'売掛金' ,'棚卸資産' ,'貸倒引当金' ,'その他流動資産' ,'流動資産合計' ,'土地' ,'建物' ,'建物減価償却累計額' ,
            '建物減損累計額' ,'建物（純額）' ,'建設仮勘定' ,'その他有形固定資産' ,'有形固定資産' ,'有形固定資産合計' ,
            'その他無形固定資産' ,'のれん' ,'無形固定資産' ,'無形固定資産合計' ,'関係会社株式' ,'投資有価証券' ,'敷金及び保証金' ,
            '繰延税金資産' ,'投資その他の資産' ,'その他投資その他の資産' ,'投資その他の資産合計' ,'固定資産合計' ,'資産合計' ,'買掛金' ,
            '未払金' ,'短期借入金' ,'その他流動負債' ,'流動負債合計' ,'長期未払金' ,'長期借入金' ,'退職給付引当金' ,'繰延税金負債' ,
            'その他固定負債' ,'固定負債合計' ,'負債合計' ,'資本金' ,'資本剰余金' ,'利益剰余金' ,'自己株式' ,'株主資本合計' ,
            'その他有価証券評価差額金' ,'為替換算調整勘定' ,'その他の包括利益累計額' ,'新株予約権' ,'非支配株主持分' ,'純資産合計' ,
            '負債・純資産合計' ,'売上高' ,'売上原価' ,'販売費及び一般管理費' ,'受取利息' ,'受取配当金' ,'持分法による投資利益' ,
            'その他営業外収益' ,'営業外収益合計' ,'支払利息' ,'持分法による投資損失' ,'その他営業外費用' ,'営業外費用合計' ,
            '固定資産売却益' ,'投資有価証券売却益' ,'その他特別利益' ,'特別利益合計' ,'減損損失' ,'投資有価証券売却損' ,'特別損失合計' ,
            '法人税等' ,'法人税等調整額' ,'法人税等合計' ,'当期純利益' ,'非支配株主に帰属する当期純利益' ,'親会社株主に帰属する当期純利益' ,
            '資本金-期首残高' ,'資本金-増資・減資による増減' ,'資本金-その他増減' ,'資本金-期末残高' ,'資本剰余金-期首残高' ,
            '資本剰余金-増資・減資による増減' ,'資本剰余金-子会社株式追加取得による増加' ,'資本剰余金-その他増減' ,'資本剰余金-期末残高' ,
            '利益剰余金-期首残高' ,'利益剰余金-当期純利益' ,'利益剰余金-支払配当金' ,'利益剰余金-その他増減' ,'利益剰余金-期末残高'
        ];
        $dals = array_map(fn ($title) => new DisclosedAccountList(['title' => $title]), $dals);
        $client->disclosed_account_lists()->saveMany($dals);
        
        $accounts = [
        [1, '現金預金', 'Cash and deposits', DetailSummary::DETAIL, Statement::BS, 1, DrCr::DR, Conversion::LAST_DAY_RATE, 101, 01, 001, 001],
        [2, '売掛金', 'xxx', DetailSummary::DETAIL, Statement::BS, 1, DrCr::DR, Conversion::LAST_DAY_RATE, 101, 02, 002, 002],
        [3, '商品', 'xxx', DetailSummary::DETAIL, Statement::BS, 1, DrCr::DR, Conversion::LAST_DAY_RATE, 101, 03, 003, 003],
        [4, '貸倒引当金', 'xxx', DetailSummary::DETAIL, Statement::BS, 1, DrCr::DR, Conversion::LAST_DAY_RATE, 101, 04, 004, 004],
        [5, 'その他流動資産', 'xxx', DetailSummary::DETAIL, Statement::BS, 1, DrCr::DR, Conversion::LAST_DAY_RATE, 101, 05, 005, 005],
        [6, '流動資産合計', 'xxx', DetailSummary::SUMMARY, Statement::BS, 1, DrCr::DR, null, null, null, 006, 006],
        [7, '土地', 'xxx', DetailSummary::DETAIL, Statement::BS, 2, DrCr::DR, Conversion::LAST_DAY_RATE, 101, 07, 007, 014],
        [8, '建物（取得原価）', 'xxx', DetailSummary::DETAIL, Statement::BS, 2, DrCr::DR, Conversion::LAST_DAY_RATE, 101, 8, 8, 14],
        [9, '建物（減価償却累計額）', 'xxx', DetailSummary::DETAIL, Statement::BS, 2, DrCr::DR, Conversion::LAST_DAY_RATE, 101, 9, 9, 14],
        [10, '建物（減損累計額）', 'xxx', DetailSummary::DETAIL, Statement::BS, 2, DrCr::DR, Conversion::LAST_DAY_RATE, 101, 10, 010, 014],
        [11, '建物（簿価）', 'xxx', DetailSummary::SUMMARY, Statement::BS, 2, DrCr::DR, null, null, null, 011, 014],
        [12, '建設仮勘定', 'xxx', DetailSummary::DETAIL, Statement::BS, 2, DrCr::DR, Conversion::LAST_DAY_RATE, 101, 12, 012, 014],
        [13, 'その他有形固定資産', 'xxx', DetailSummary::DETAIL, Statement::BS, 2, DrCr::DR, Conversion::LAST_DAY_RATE, 101, 13, 013, 014],
        [14, '有形固定資産合計', 'xxx', DetailSummary::SUMMARY, Statement::BS, 2, DrCr::DR, null, null, null, 015, 014],
        [15, 'ソフトウェア', 'xxx', DetailSummary::DETAIL, Statement::BS, 2, DrCr::DR, Conversion::LAST_DAY_RATE, 101, 15, 16, 18],
        [16, 'のれん（取得原価）', 'xxx', DetailSummary::DETAIL, Statement::BS, 2, DrCr::DR, Conversion::LAST_DAY_RATE, 101, 16, 017, 18],
        [17, 'のれん（減価償却累計額）', 'xxx', DetailSummary::DETAIL, Statement::BS, 2, DrCr::DR, Conversion::LAST_DAY_RATE, 101, 17, 017, 18],
        [18, 'のれん（減損累計額）', 'xxx', DetailSummary::DETAIL, Statement::BS, 2, DrCr::DR, Conversion::LAST_DAY_RATE, 101, 18, 017, 18],
        [19, 'のれん（簿価）', 'xxx', DetailSummary::SUMMARY, Statement::BS, 2, DrCr::DR, null, null, null, 17, 18],
        [20, 'その他無形固定資産', 'xxx', DetailSummary::DETAIL, Statement::BS, 2, DrCr::DR, Conversion::LAST_DAY_RATE, 101, 20, 016, 18],
        [21, '無形固定資産合計', 'xxx', DetailSummary::SUMMARY, Statement::BS, 2, DrCr::DR, null, null, null, 19, 18],
        [22, '子会社株式', 'xxx', DetailSummary::DETAIL, Statement::BS, 2, DrCr::DR, Conversion::LAST_DAY_RATE, 101, 22, 020, 024],
        [23, '関連会社株式', 'xxx', DetailSummary::DETAIL, Statement::BS, 2, DrCr::DR, Conversion::LAST_DAY_RATE, 101, 23, 021, 024],
        [24, '敷金保証金', 'xxx', DetailSummary::DETAIL, Statement::BS, 2, DrCr::DR, Conversion::LAST_DAY_RATE, 101, 24, 022, 024],
        [25, '繰延税金資産', 'xxx', DetailSummary::DETAIL, Statement::BS, 2, DrCr::DR, Conversion::LAST_DAY_RATE, 101, 25, 023, 024],
        [26, 'その他固定資産', 'xxx', DetailSummary::DETAIL, Statement::BS, 2, DrCr::DR, Conversion::LAST_DAY_RATE, 101, 26, 025, 024],
        [27, '投資その他の資産合計', 'xxx', DetailSummary::SUMMARY, Statement::BS, 2, DrCr::DR, null, null, null, 026, 024],
        [28, '固定資産合計', 'xxx', DetailSummary::SUMMARY, Statement::BS, 2, DrCr::DR, null, null, null, 027, 027],
        [29, '資産合計', 'xxx', DetailSummary::SUMMARY, Statement::BS, 3, DrCr::DR, null, null, null, 28, 28],
        [30, '買掛金', 'xxx', DetailSummary::DETAIL, Statement::BS, 4, DrCr::CR, Conversion::LAST_DAY_RATE, 101, 30, 29, 29],
        [31, '未払金', 'xxx', DetailSummary::DETAIL, Statement::BS, 4, DrCr::CR, Conversion::LAST_DAY_RATE, 101, 31, 030, 030],
        [32, '短期借入金', 'xxx', DetailSummary::DETAIL, Statement::BS, 4, DrCr::CR, Conversion::LAST_DAY_RATE, 101, 32, 031, 031],
        [33, 'その他流動負債', 'xxx', DetailSummary::DETAIL, Statement::BS, 4, DrCr::CR, Conversion::LAST_DAY_RATE, 101, 33, 032, 032],
        [34, '流動負債合計', 'xxx', DetailSummary::SUMMARY, Statement::BS, 4, DrCr::CR, null, null, null, 033, 033],
        [35, '長期未払金', 'xxx', DetailSummary::DETAIL, Statement::BS, 5, DrCr::CR, Conversion::LAST_DAY_RATE, 101, 35, 034, 034],
        [36, '長期借入金', 'xxx', DetailSummary::DETAIL, Statement::BS, 5, DrCr::CR, Conversion::LAST_DAY_RATE, 101, 36, 035, 035],
        [37, '退職給付引当金', 'xxx', DetailSummary::DETAIL, Statement::BS, 5, DrCr::CR, Conversion::LAST_DAY_RATE, 101, 37, 036, 036],
        [38, '繰延税金負債', 'xxx', DetailSummary::DETAIL, Statement::BS, 5, DrCr::CR, Conversion::LAST_DAY_RATE, 101, 38, 037, 037],
        [39, 'その他固定負債', 'xxx', DetailSummary::DETAIL, Statement::BS, 5, DrCr::CR, Conversion::LAST_DAY_RATE, 101, 39, 38, 38],
        [40, '固定負債合計', 'xxx', DetailSummary::SUMMARY, Statement::BS, 5, DrCr::CR, null, null, null, 39, 39],
        [41, '負債合計', 'xxx', DetailSummary::SUMMARY, Statement::BS, 6, DrCr::CR, null, null, null, 040, 040],
        [42, '資本金', 'xxx', DetailSummary::SUMMARY, Statement::BS, 7, DrCr::CR, null, null, null, 041, 041],
        [43, '資本剰余金', 'xxx', DetailSummary::SUMMARY, Statement::BS, 7, DrCr::CR, null, null, null, 042, 042],
        [44, '利益剰余金', 'xxx', DetailSummary::SUMMARY, Statement::BS, 7, DrCr::CR, null, null, null, 043, 043],
        [45, '自己株式', 'xxx', DetailSummary::SUMMARY, Statement::BS, 7, DrCr::CR, Conversion::LAST_DAY_RATE, 101, 45, 044, 044],
        [46, '株主資本計', 'xxx', DetailSummary::SUMMARY, Statement::BS, 7, DrCr::CR, null, null, null, 045, 045],
        [47, 'その他有価証券評価差額金', 'xxx', DetailSummary::SUMMARY, Statement::BS, 7, DrCr::CR, null, null, null, 046, 046],
        [48, '為替換算調整勘定', 'xxx', DetailSummary::SUMMARY, Statement::BS, 7, DrCr::CR, null, null, null, 047, 047],
        [49, 'その他の包括利益累計額', 'xxx', DetailSummary::SUMMARY, Statement::BS, 7, DrCr::CR, null, null, null, 48, 48],
        [50, '新株予約権', 'xxx', DetailSummary::DETAIL, Statement::BS, 7, DrCr::CR, Conversion::LAST_DAY_RATE, 101, 50, 49, 49],
        [51, '非支配株主持分', 'xxx', DetailSummary::DETAIL, Statement::BS, 7, DrCr::CR, Conversion::LAST_DAY_RATE, 101, 51, 050, 050],
        [52, '純資産合計', 'xxx', DetailSummary::SUMMARY, Statement::BS, 7, DrCr::CR, null, null, null, 051, 051],
        [53, '負債・純資産合計', 'xxx', DetailSummary::SUMMARY, Statement::BS, 8, DrCr::CR, null, null, null, 052, 052],
        [54, '販売売上', 'xxx', DetailSummary::DETAIL, Statement::PL, 9, DrCr::CR, Conversion::AVERAGE_RATE, 101, 113, 053, 053],
        [55, 'サービス売上', 'xxx', DetailSummary::DETAIL, Statement::PL, 9, DrCr::CR, Conversion::AVERAGE_RATE, 101, 113, 053, 053],
        [56, 'その他売上', 'xxx', DetailSummary::DETAIL, Statement::PL, 9, DrCr::CR, Conversion::AVERAGE_RATE, 101, 113, 053, 053],
        [57, '売上高計', 'xxx', DetailSummary::SUMMARY, Statement::PL, 9, DrCr::CR, null, null, null, 053, 053],
        [58, '販売原価', 'xxx', DetailSummary::DETAIL, Statement::PL, 10, DrCr::DR, Conversion::AVERAGE_RATE, 101, 113, 054, 054],
        [59, 'サービス原価', 'xxx', DetailSummary::DETAIL, Statement::PL, 10, DrCr::DR, Conversion::AVERAGE_RATE, 101, 113, 054, 054],
        [60, 'その他原価', 'xxx', DetailSummary::DETAIL, Statement::PL, 10, DrCr::DR, Conversion::AVERAGE_RATE, 101, 113, 054, 054],
        [61, '売上原価計', 'xxx', DetailSummary::SUMMARY, Statement::PL, 10, DrCr::DR, null, null, null, 054, 054],
        [101, '為替換算調整勘定-換算調整', 'xxx', DetailSummary::DETAIL, Statement::CI, 24, DrCr::CR, Conversion::BALANCE, 101, 98, 47, 47]
        ];

        Account::insert(
            array_map(function ($account) {
                return [
                    'code' => $account[0],
                    'title' => $account[1],
                    'title_en' => $account[2],
                    'detail_summary' => $account[3],
                    'statement' => $account[4],
                    'category_id' => $account[5],
                    'dr_cr' => $account[6],
                    'conversion' => $account[7],
                    'fcta_account_id' => $account[8],
                    'carryover_account_id' => $account[9],
                    'year_disclosed_account_list_id' => $account[10],
                    'quarter_disclosed_account_list_id' => $account[11],
                    'enabled' => true
                ];
            }, $accounts)
        );
        $terms = [
            ['month' => '2023-3', 'type' => TermType::RESULTS, 'period' => TermPeriod::YEAR],
            ['month' => '2023-6', 'type' => TermType::RESULTS, 'period' => TermPeriod::QUARTER],
            ['month' => '2023-9', 'type' => TermType::RESULTS, 'period' => TermPeriod::QUARTER],
            ['month' => '2023-12', 'type' => TermType::RESULTS, 'period' => TermPeriod::QUARTER],
            ['month' => '2024-3', 'type' => TermType::RESULTS, 'period' => TermPeriod::YEAR],
            ['month' => '2024-3', 'type' => TermType::EXPECTED, 'period' => TermPeriod::YEAR],
            ['month' => '2025-3', 'type' => TermType::PLAN, 'period' => TermPeriod::YEAR]
        ];
        $client->terms()->saveMany(array_map(fn ($term) => new Term([...$term, 'group' => TermGroup::RESULTS]), $terms));

        $client->currencies()->saveMany([
            $currency1 = new Currency(['title' => '日本円']),
            $currency2 = new Currency(['title' => 'USドル 12月決算']),
            $currency3 = new Currency(['title' => '中国元 12月決算']),
            $currency4 = new Currency(['title' => 'USドル 3月決算'])
        ]);

        // $term->rates()->saveMany([
        //     new Rate(['currency_id' => $currency->id, 'last_day_rate' => 150.23, 'average_rate' => 147.82]),
        // ]);

        $companies = [
            ['title' => 'A株式会社', 'fiscal_month' => 3, 'currency_id' => $currency1->id, 'businesses' => [$b1->id, $b3->id, $b5->id, $b6->id], 'business_id' => $b1->id],
            ['title' => 'B株式会社', 'fiscal_month' => 3, 'currency_id' => $currency1->id, 'businesses' => [$b1->id, $b3->id], 'business_id' => $b1->id],
            ['title' => 'C株式会社', 'fiscal_month' => 12, 'currency_id' => $currency2->id, 'businesses' => [$b2->id], 'business_id' => $b2->id],
            ['title' => 'D株式会社', 'fiscal_month' => 12, 'currency_id' => $currency3->id, 'businesses' => [$b4->id, $b7->id], 'business_id' => $b7->id],
            ['title' => 'E株式会社', 'fiscal_month' => 3, 'currency_id' => $currency1->id, 'businesses' => [$b5->id], 'business_id' => $b5->id],
            ['title' => 'F株式会社', 'fiscal_month' => 2, 'currency_id' => $currency1->id, 'businesses' => [$b7->id], 'business_id' => $b7->id]
        ];

        foreach ($companies as $company) {
            $c = $client->companies()->save(new Company([
                'title' => $company['title'],
                'fiscal_month' => $company['fiscal_month'],
                'currency_id' => $company['currency_id'],
                'business_id' => $company['business_id'],
            ]));
            $c->businesses()->attach($company['businesses']);
        }

        // $term->scopes()->saveMany([
        //     new Scope(['company_id' => $company->id, 'relation' => ScopeRelation::PARENT]),
        //     new Scope(['company_id' => $company2->id, 'relation' => ScopeRelation::EQUITY_METHOD_AFFILIATE])
        // ]);

        $client->journal_categories()->saveMany([
            $jc1 = new JournalCategory(['modify' => Modify::CONSOLIDATED, 'title' => "投資と資本の相殺消去", 'carryover' => Carryover::CARRYOVER]),
            new JournalCategory(['modify' => Modify::CONSOLIDATED, 'title' => "債権債務相殺消去", 'carryover' => Carryover::IGNORE]),
            new JournalCategory(['modify' => Modify::CONSOLIDATED, 'title' => "取引高相殺消去", 'carryover' => Carryover::IGNORE]),
            new JournalCategory(['modify' => Modify::CONSOLIDATED, 'title' => "棚卸資産未実現利益消去", 'carryover' => Carryover::REVERSAL]),
            $jc5 = new JournalCategory(['modify' => Modify::INDIVIDUAL, 'title' => "個別修正仕訳", 'carryover' => Carryover::IGNORE]),
        ]);

        $jc1->subcategories()->saveMany([
            new JournalSubcategory(['title' => 'B社']),
            new JournalSubcategory(['title' => 'C社'])
        ]);

        $jc5->subcategories()->saveMany([
            new JournalSubcategory(['title' => '長短分類修正']),
            new JournalSubcategory(['title' => '〇〇調整仕訳'])
        ]);
    }
}
