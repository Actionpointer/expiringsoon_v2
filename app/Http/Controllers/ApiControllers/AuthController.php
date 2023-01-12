<?php

namespace App\Http\Controllers\ApiControllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\OneTimePassword;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\GeoLocationTrait;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    use GeoLocationTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
                'role' => ['required', 'string'],
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'error' => $validateUser->errors()->first()
                ], 401);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'fname' => $request->fname,
                'lname' => $request->lname,
                'phone' => $request->phone,
                'phone_prefix' => cache('settings')['dialing_code'],
                'state_id' => $this->currentState()->id,
                'role' => $request->role ?? 'shopper',
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
    public function login_vendor(Request $request)
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
                    'message' => 'validation error',
                    'error' => $validateUser->errors()->first()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();
            if($user->role != 'vendor'){
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized Login Attempt',
                ], 401);
            }
            $user->tokens()->delete();
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

    public function generate_otp(){
        $user = auth()->user();
        $otp = OneTimePassword::where('user_id',auth()->id())->whereBetween('created_at',[now()->subMinutes(cache('settings')['throttle_otp_time']),now()])->latest()->first();
        if(!$otp){
            $otp = OneTimePassword::create(['user_id'=> $user->id,'code'=> strtoupper(substr(uniqid(),4,6))]);
        }
        $result = $this->checkOTP($otp->code);
        return response()->json(['otp'=> $result['result'],'message'=> $result['message']],200);
    }

    
    public function access_pin(Request $request)
    {
        //
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
