<?php 

namespace App\Enums;

enum DrCr: int {
  case DR = 1;
  case CR = 2;

  public function title(): string {
    return match($this) {
      self::DR => '借方',
      self::CR => '貸方'
    };
  }
}