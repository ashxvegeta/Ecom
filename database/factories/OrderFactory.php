<?php

namespace Database\Factories;

use App\Models\Order;
use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;
    public function definition(): array
    {
        return [
            'user_id'         => 1,
            'order_number'    => 'ORD-' . strtoupper(uniqid()),
            'first_name'      => $this->faker->firstName(),
            'last_name'       => $this->faker->lastName(),
            'email'           => $this->faker->email(),
            'phone'           => $this->faker->phoneNumber(),
            'address'         => $this->faker->address(),
            'city'            => $this->faker->city(),
            'state'           => $this->faker->state(),
            'pincode'         => $this->faker->postcode(),
            'subtotal'        => 1000,
            'shipping_charge' => 0,
            'grand_total'     => 1000,
            'payment_method'  => 'cod',
            'payment_status'  => PaymentStatus::PENDING,
            'order_status'    => OrderStatus::PENDING,
        ];
    }
}
