<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Traits\AuthTrait;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers, AuthTrait;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {
        // Map the request data to the format expected by registerUser
        $data = [
            'firstname' => $request->firstname,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => $request->password,
        ];

        $result = $this->registerUser($data);
        
        if (!$result['status']) {
            return response()->json([
                'status' => false,
                'message' => $result['message'],
                'errors' => $result['errors'] ?? null
            ], 422);
        }

        $user = $result['user'];
        
        // For API requests, create and return a token
        $token = $user->createToken("API TOKEN")->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Registered successfully',
            'token' => $token,
            'user' => $user
        ], 201);
    }
    
    
}
