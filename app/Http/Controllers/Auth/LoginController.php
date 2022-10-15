<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
        $this->middleware('guest')->except('logout');
        $this->decayMinutes = cache('settings')['throttle_login_time'];
        $this->maxAttempts = cache('settings')['throttle_login_attempt'];
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }
    

    protected function authenticated(Request $request, $user)
    {
        if(!$user->status){
            Auth::logout();
            return redirect('login')->with(['result'=>0,'message'=> 'Account Suspended']);
        }
    }
}
