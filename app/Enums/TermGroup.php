<?php 

namespace App\Enums;

enum TermGroup: int {
  case RESULTS = 1;
  case FUTURE = 2;

  public function title(): string {
    return match($this) {
      self::RESULTS => '実績',
      self::FUTURE => '将来情報',
    };
  }
}