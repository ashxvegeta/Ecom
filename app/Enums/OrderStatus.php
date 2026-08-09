<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PENDING   = 'pending';
    case CONFIRMED = 'confirmed';
    case SHIPPED   = 'shipped';
    case DELIVERED = 'delivered';
    case CANCELLED = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::PENDING   => 'Pending',
            self::CONFIRMED => 'Confirmed',
            self::SHIPPED   => 'Shipped',
            self::DELIVERED => 'Delivered',
            self::CANCELLED => 'Cancelled',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::PENDING   => 'warning',
            self::CONFIRMED => 'info',
            self::SHIPPED   => 'primary',
            self::DELIVERED => 'success',
            self::CANCELLED => 'danger',
        };
    }
}