<?php 

namespace App\Enums;

enum Conversion: int {
  case LAST_DAY_RATE = 1;
  case AVERAGE_RATE = 2;

  public function title(): string {
    return match($this) {
      self::LAST_DAY_RATE => '期末日レート',
      self::AVERAGE_RATE => '期中平均レート'
    };
  }
}