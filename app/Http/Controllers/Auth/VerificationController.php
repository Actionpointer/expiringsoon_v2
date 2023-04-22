<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Access\AuthorizationException;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('verify');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $request->wantsJson()
                        ? response()->json(['status'=> true,'message'=> 'Email is already verified'], 204)
                        : redirect($this->redirectPath());
        }

        $request->user()->sendEmailVerificationNotification();

        return $request->wantsJson()
                    ? response()->json(['status'=> true,'message'=> 'Verification instructions has been sent to your email'], 202)
                    : back()->with('resent', true);
    }

    public function verify(Request $request)
    {
        $user = User::find($request->route('id'));
        if (! hash_equals((string) $request->route('id'), (string) $user->getKey())) {
            return $request->wantsJson()
                ? response()->json(['status'=> false,'message'=> 'This action is unauthorized'], 403)
                : throw new AuthorizationException;
        }

        if (! hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            return $request->wantsJson()
                ? response()->json(['status'=> false,'message'=> 'This action is unauthorized'], 403)
                : throw new AuthorizationException;
        }

        if ($user->hasVerifiedEmail()) {
            return $request->wantsJson()
                        ? response()->json(['status'=> true,'message'=> 'Email is already verified'], 204)
                        : redirect($this->redirectPath())->with('verified', true);
        }

        if ($user->markEmailAsVerified()) {

            event(new Verified($user));
        }

        if ($response = $this->verified($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? response()->json(['status'=> true,'message'=> 'Email has been verified'], 204)
            : redirect($this->redirectPath())->with('verified', true);

    }

    protected function verified(Request $request){
        $user = User::find($request->route('id'));
        if($user->country->payout_gateway == 'paypal'){
            $user->payout_account = $user->email;
            $user->save();
        }
    }
}
