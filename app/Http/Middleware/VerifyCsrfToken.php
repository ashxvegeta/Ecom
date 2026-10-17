<?php
class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'api/webhook/razorpay', // Exclude the Razorpay webhook route from CSRF verification
    ];
}