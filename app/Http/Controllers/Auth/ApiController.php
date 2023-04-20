<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\GeoLocationTrait;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{

    use GeoLocationTrait;
    
    public function webhook(Request $request){
        logger()->info([
            'payload' => $request->all(),
            'headers' => $request->headers,
        ]);
        // $alert = \App\Models\Alert::create(['severity'=> 1,'description'=> 'Webhook','status'=> 1]);
        return response()->json(200);
    }

    public function register(Request $request)
    {
        try {
            //Validated
            $validateUser = Validator::make($request->all(), 
            [
                'fname' => ['required', 'string', 'max:255'],
                'lname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone' => ['required', 'string', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => $validateUser->errors()->first(),
                ], 401);
            }
            $role_id = Role::where('name','vendor')->first()->id;
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'fname' => $request->fname,
                'lname' => $request->lname,
                'phone' => $request->phone,
                'country_id' => session('locale')['country_id'],
                'state_id' => session('locale')['state_id'],
                'role_id' => $role_id,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
           
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), 
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => $validateUser->errors()->first()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();
            if($user->role->name != 'vendor'){
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized Login Attempt',
                ], 401);
            }
            if(!$user->status){
                return response()->json([
                    'status' => false,
                    'message' => 'Account Suspended',
                ], 401);
            }
            if($user->subscription_id){
                if(!$user->subscription->active && !$user->subscription->is_free){
                    $user->subscription_id = $user->subscriptions->firstWhere('is_free',true)->id;
                    $user->save();
                }
            }
            // $user->tokens()->delete();
            return response()->json([
                'status' => true,
                'message' => 'Login successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        $user = Auth::user();
        $user->tokens()->delete();
        return [
            'message' => 'Tokens Revoked'
        ];
    }
  
}
