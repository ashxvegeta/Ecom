<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use App\Enums\PaymentMethod;

class Order extends Model
{
    //

    protected $fillable = [
        'user_id',
        'order_number',

        'first_name',
        'last_name',
        'email',
        'phone',

        'address',
        'city',
        'state',
        'pincode',

        'subtotal',
        'shipping_charge',
        'grand_total',

        'payment_method',
        'payment_status',
        'order_status',
    ];


    public function items()
    {
        return $this->hasMany(OrderItem::class);

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'order_status'   => OrderStatus::class,
        'payment_status' => PaymentStatus::class,
        'payment_method' => PaymentMethod::class,
    ];

}
