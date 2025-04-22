<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (\Exception $e) {
            if ($e->getPrevious() instanceof \Illuminate\Session\TokenMismatchException) {
                return redirect()->route('login');
            };
        });

        // $this->renderable(function (\Exception $e, $request) {
        //     if ($e->getPrevious() instanceof \Illuminate\Session\TokenMismatchException) {
        //         // If it's an API request, return JSON response
        //         if ($request->expectsJson()) {
        //             return response()->json(['message' => 'Unauthenticated'], 401);
        //         }
        //         // For web requests, redirect to login
        //         return response()->json(['message' => 'Unauthorized'], 401);
        //     };
        // });

        // $this->renderable(function (AuthenticationException $e, $request) {
        //     if ($request->expectsJson()) {
        //         return response()->json(['message' => 'Unauthenticated'], 401);
        //     }
        // });
    }
}
