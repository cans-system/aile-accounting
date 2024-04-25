<?php 

namespace App\Enums;

enum Statement: int {
  case BS = 1;
  case PL = 2;
  case CI = 3;
  case CN = 4;

  public function title(): string {
    return match($this) {
      self::BS => '貸借対照表',
      self::PL => '損益計算書',
      self::CI => '包括利益計算書',
      self::CN => '株主資本等変動計算書'
    };
  }
}