<?php

namespace App\Services;

use Twilio\Rest\Client;
use Twilio\Exceptions\RestException;
use Illuminate\Support\Facades\Log;

class SmsService
{
    protected $client;
    protected $from;

    public function __construct()
    {
        $this->client = new Client(
            config('services.twilio.sid'),
            config('services.twilio.token')
        );
        $this->from = config('services.twilio.from');
    }

    /**
     * Normalize phone number to international E.164 format (+91XXXXXXXXXX)
     */
    public function formatPhoneNumber(string $phone): string
    {
        $cleaned = preg_replace('/[^0-9+]/', '', trim($phone));

        if (str_starts_with($cleaned, '+')) {
            return $cleaned;
        }

        if (str_starts_with($cleaned, '91') && strlen($cleaned) === 12) {
            return '+' . $cleaned;
        }

        if (str_starts_with($cleaned, '0') && strlen($cleaned) === 11) {
            return '+91' . substr($cleaned, 1);
        }

        if (strlen($cleaned) === 10) {
            return '+91' . $cleaned;
        }

        return '+' . ltrim($cleaned, '+');
    }

    public function sendSms(string $to, string $message): void
    {
        $formattedTo = $this->formatPhoneNumber($to);

        try {
            $this->client->messages->create($formattedTo, [
                'from' => $this->from,
                'body' => $message,
            ]);
            Log::info("SMS successfully sent to {$formattedTo}");
        } catch (RestException $e) {
            // Error Code 572006: Twilio trial accounts cannot send custom body text.
            // They can only send predefined templates like 'sms_order_confirmation'.
            if ($e->getCode() === 572006 || str_contains($e->getMessage(), 'predefined SMS templates')) {
                Log::warning("Twilio trial account detected (Code 572006). Falling back to predefined template 'sms_order_confirmation' for {$formattedTo}.");
                try {
                    $this->client->messages->create($formattedTo, [
                        'from' => $this->from,
                        'body' => 'sms_order_confirmation',
                    ]);
                    Log::info("Fallback template SMS successfully sent to {$formattedTo}");
                    return;
                } catch (\Exception $fallbackEx) {
                    Log::error('Twilio Fallback SMS Error: ' . $fallbackEx->getMessage());
                }
            } else {
                Log::error("Twilio SMS Error: [Code {$e->getCode()}] " . $e->getMessage());
            }
        } catch (\Exception $e) {
            Log::error('SMS Error: ' . $e->getMessage());
        }
    }
}