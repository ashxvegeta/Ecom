<?php

namespace App\Actions\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginUserAction
{
   public function execute(array $data): array
   {
       // Find the user by email
       $user = User::where('email', $data['email'])->first();

       // Check if the user exists and the password is correct
       if (!$user || !Hash::check($data['password'], $user->password)) {
           throw ValidationException::withMessages([
               'email' => ['The provided credentials are incorrect.'],
           ]);
       }

       // Generate a token for the user
       $token = $user->createToken('auth_token')->plainTextToken;

       return [
            'message' => 'User logged in successfully',
            'token' => $token,
            'user' => $user,
       ];
   }
}
