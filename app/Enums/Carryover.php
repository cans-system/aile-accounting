<?php 

namespace App\Enums;

enum Carryover: int {
  case CARRYOVER = 1;
  case IGNORE = 2;
  case REVERSAL = 3;

  public function title(): string {
    return match($this) {
      self::CARRYOVER => '繰越',
      self::IGNORE => '不要',
      self::REVERSAL => '翌期洗替'
    };
  }
}