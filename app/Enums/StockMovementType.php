<?php

namespace App\Enums;

enum StockMovementType: string {
    case Purchase = 'purchase';
    case Sale = 'sale';
    case ReturnFromCustomer = 'return_from_customer';
    case ReturnToSupplier = 'return_to_supplier';
    case Adjustment = 'adjustment';
    case WriteOff = 'write_off';
    case CostAdjustment = 'cost_adjustment';

    public static function costAffecting(): array {
        return [
            self::Purchase,
            self::ReturnToSupplier,
            self::CostAdjustment,
        ];
    }
    public static function increasesStock(): array {
        return [
            self::Purchase,
            self::ReturnFromCustomer,
            self::Adjustment,
        ];
    }

    public static function decreasesStock(): array {
        return [
            self::Sale,
            self::ReturnToSupplier,
        ];
    }
}
