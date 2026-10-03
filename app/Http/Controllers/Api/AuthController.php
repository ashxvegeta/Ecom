<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\LoginRequest;
use App\Actions\Auth\RegisterUserAction;
use App\Actions\Auth\LoginUserAction;
use OpenApi\Attributes as OA;

class AuthController extends Controller
{
    //
    #[OA\Post(
        path: '/api/register',
        summary: 'User Registration',
        tags: ['Auth'],
        requestBody: new OA\RequestBody(
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'name', type: 'string', example: 'John Doe'),
                    new OA\Property(property: 'email', type: 'string', example: 'user@example.com'),
                    new OA\Property(property: 'password', type: 'string', example: 'password123'),
                    new OA\Property(property: 'password_confirmation', type: 'string', example: 'password123')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Registration successful'),
            new OA\Response(response: 422, description: 'Validation errors')
        ]
    )]
    public function register(RegisterRequest $request, RegisterUserAction $action)
    {
        $result = $action->execute($request->validated());
        return response()->json($result);
    }

    #[OA\Post(
        path: '/api/login',
        summary: 'User Login',
        tags: ['Auth'],
        requestBody: new OA\RequestBody(
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'email', type: 'string', example: 'user@example.com'),
                    new OA\Property(property: 'password', type: 'string', example: 'password123')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Login successful'),
            new OA\Response(response: 401, description: 'Invalid credentials')
        ]
    )]
    public function login(LoginRequest $request, LoginUserAction $action)
    {
        $result = $action->execute($request->validated());
        return response()->json($result);
    }

    #[OA\Post(
        path: '/api/logout',
        summary: 'User Logout',
        tags: ['Auth'],
        security: [['sanctum' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Logged out successfully'),
            new OA\Response(response: 401, description: 'Unauthenticated')
        ]
    )]
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
