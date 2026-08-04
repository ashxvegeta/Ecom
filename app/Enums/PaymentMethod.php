<?php

namespace App\Enums;

enum PaymentMethod: string
{
    case COD = 'cod';
    case RAZORPAY = 'razorpay';

    public function label(): string
    {
        return match ($this) {
            self::COD => 'Cash on Delivery',
            self::RAZORPAY => 'Razorpay',
        };
    }
}