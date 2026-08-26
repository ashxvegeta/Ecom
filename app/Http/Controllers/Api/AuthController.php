<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\LoginRequest;
use App\Actions\Auth\RegisterUserAction;
use App\Actions\Auth\LoginUserAction;


class AuthController extends Controller
{
    //
    public function register(RegisterRequest $request, RegisterUserAction $action)
    {
        $result = $action->execute($request->validated());
        return response()->json($result);
    }

    public function login(LoginRequest $request, LoginUserAction $action)
    {
        $result = $action->execute($request->validated());
        return response()->json($result);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
