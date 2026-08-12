<?php
namespace App\Services;

use Razorpay\Api\Api;

class RazorpayService
{
    protected Api $api;

    public function __construct()
    {
        $this->api = new Api(
            config('services.razorpay.key_id'),
            config('services.razorpay.key_secret')
        );
    }

    public function createOrder(float $amount): array
    {
        $order = $this->api->order->create([
            'amount'   => $amount * 100,
            'currency' => 'INR',
            'receipt'  => 'TZ-' . uniqid(),
        ]);

        return $order->toArray();
    }

    public function verifyPayment(string $orderId, string $paymentId, string $signature): bool
    {
        $payload = $orderId . '|' . $paymentId;
        $expectedSignature = hash_hmac('sha256', $payload, config('services.razorpay.key_secret'));
        return $expectedSignature === $signature;
    }
}