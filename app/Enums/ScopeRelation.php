<?php 

namespace App\Enums;

enum ScopeRelation: int {
  case PARENT = 1;
  case SUBSIDIARY = 2;
  case EQUITY_METHOD_AFFILIATE = 3;
  case NON_CONSOLIDATED = 4;

  public function title(): string {
    return match($this) {
      self::PARENT => '親会社',
      self::SUBSIDIARY => '連結子会社',
      self::EQUITY_METHOD_AFFILIATE => '持分法適用会社',
      self::NON_CONSOLIDATED => '非連結会社'
    };
  }
}