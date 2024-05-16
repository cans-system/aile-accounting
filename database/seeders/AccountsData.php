<?php

namespace Database\Seeders;

use App\Enums\Conversion;
use App\Enums\DetailSummary;
use App\Enums\DrCr;
use App\Enums\Statement;

class AccountsData
{
  public static $data = [
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
}
