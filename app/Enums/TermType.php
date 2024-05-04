<?php 

namespace App\Enums;

enum TermType: int {
  case RESULTS = 1;
  case PLAN = 2;
  case EXPECTED = 3;
  case BUDGET = 4;

  public function title(): string {
    return match($this) {
      self::RESULTS => '実績',
      self::PLAN => '計画',
      self::EXPECTED => '見込',
      self::BUDGET => '予算',
    };
  }
}