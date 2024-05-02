<?php 

namespace App\Enums;

enum DetailSummary: int {
  case DETAIL = 1;
  case SUMMARY = 2;

  public function title(): string {
    return match($this) {
      self::DETAIL => '明細科目',
      self::SUMMARY => '集計科目'
    };
  }
}