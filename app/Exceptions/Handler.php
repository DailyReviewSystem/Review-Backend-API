<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
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
        $this->renderable(function( AuthenticationException $e ) {
            return response()->json([
                "msg" => $e->getMessage() ?? "unauthenticated"
            ], 401 );
        });

        $this->renderable(function( ValidationException $e ) {
            return response()->json([
                "msg" => "invalid data"
            ], 422 );
        });

        $this->renderable(function( AuthorizationException $e ) {
            return response()->json([
                "msg" => "unauthorized"
            ], 403 );
        });

        $this->renderable(function( HttpException $e) {
            $msg_list = [
                401 => "unauthenticated",
                403 => "unauthorized",
                422 => "invalid data",
            ];

            $msg = $e->getMessage();
            $code = $e->getStatusCode();

            if( ! isset($msg) || $msg === "" ) {
                $msg = isset($msg_list[$code]) ? $msg_list[$code] : "WRONG";
            }

            return response()->json([
                "msg" => $msg
            ], $code );
        });
    }
}
