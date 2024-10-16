<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions
     * @var string[]
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation'
    ];

    /**
     * Register the exception handling callbacks for the application
     * @return void
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            // TODO: Implement reportable() exception
        });

        $this->renderable(function (Throwable $e) {
            // TODO: Implement renderable() exception
        });
    }
}
