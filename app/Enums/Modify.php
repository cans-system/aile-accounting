<?php 

namespace App\Enums;

enum Modify: int {
  case INDIVIDUAL = 1;
  case CONSOLIDATED = 2;

  public function title(): string {
    return match($this) {
      self::INDIVIDUAL => '個別修正',
      self::CONSOLIDATED => '連結修正'
    };
  }
}