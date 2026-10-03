<?php

namespace App\Http\Controllers;


use OpenApi\Attributes as OA;

#[OA\Info(
    title: "TechZone API",
    version: "1.0.0",
    description: "TechZone E-Commerce REST API Documentation"
)]
#[OA\Server(
    url: "http://localhost/Ecom-main/public",
    description: "XAMPP Server"
)]
#[OA\Server(
    url: "http://127.0.0.1:8000",
    description: "Artisan Serve (Local)"
)]
#[OA\SecurityScheme(
    securityScheme: "sanctum",
    type: "http",
    scheme: "bearer",
    bearerFormat: "JWT",
    description: "Enter your Sanctum token (obtained from /api/login or /api/register)"
)]
abstract class Controller
{
    //
}
