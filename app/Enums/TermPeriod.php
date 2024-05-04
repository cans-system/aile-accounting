<?php 

namespace App\Enums;

enum TermPeriod: int {
  case MONTHLY = 1;
  case QUARTER = 2;
  case YEAR = 3;

  public function title(): string {
    return match($this) {
      self::MONTHLY => '月次',
      self::QUARTER => '四半期',
      self::YEAR => '年度',
    };
  }
}