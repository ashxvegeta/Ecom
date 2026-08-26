<?php

namespace App\Actions\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterUserAction
{
   public function execute(array $data): array
   {
       // Create a new user
       $user = User::create([
           'name' => $data['name'],
           'email' => $data['email'],
           'password' => Hash::make($data['password']),
       ]);

       // Generate a token for the user
       $token = $user->createToken('auth_token')->plainTextToken;

       return [
            'message' => 'User registered successfully',
            'token' => $token,
            'user' => $user,
       ];
   }
}
