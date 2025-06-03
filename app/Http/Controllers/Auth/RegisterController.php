<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\GeoLocationTrait;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Traits\AuthTrait;

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
            'first_name' => $request->firstname,
            'last_name' => $request->surname,
            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
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
