<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Traits\AuthTrait;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    use AuthTrait;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected $decayMinutes;
    public $maxAttempts; // number of attempts before lockout
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout','signOut','force_password_change','force_password_change_form']);
        $this->decayMinutes = 60;
        $this->maxAttempts = 5;
    }
    public function showLoginForm(){
        return view('backend.auth.login');
    }

    public function signOut()
    {
         /** @var \App\Models\User $user **/
        $user = Auth::user();
        $user->tokens()->delete();
        return [
            'message' => 'Tokens Revoked'
        ];
    }
    
    protected function authenticated(Request $request, $user)
    {
        if(!$user->status || !$user->is_admin){
            Auth::logout();
            return redirect('login')->with(['result'=>0,'message'=> 'Invalid Account']);
        }
    }

    public function force_password_change_form(Request $request){
        if($request->user()->require_password_change){
            return view('backend.auth.passwords.forcepassword');
        }
        return redirect()->route('admin.dashboard')->with(['result'=>0,'message'=> 'Invalid Request']);
    }


    public function force_password_change(Request $request){
         
        $validator = Validator::make($request->all(), [
            'password' => 'required','string','confirmed'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        /** @var \App\Models\User $user **/
        $user = auth()->user();
        $user->password = Hash::make($request->password);
        $user->require_password_change = false;
        $user->save();
        return redirect()->route('admin.dashboard')->with(['result'=>1,'message'=> 'Password Changed']);
    }  

    /**
     * Handle API login request
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiLogin(Request $request)
    {
        $result = $this->loginUser($request->all());
        
        if (!$result['status']) {
            return response()->json([
                'status' => false,
                'message' => $result['message']
            ], 401);
        }
        
        $user = $result['user'];
        
        // For API requests, create and return a token
        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'token' => $user->createToken("API TOKEN")->plainTextToken
        ], 200);
    }

}
