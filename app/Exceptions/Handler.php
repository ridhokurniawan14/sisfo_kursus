<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontReport = [];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ModelNotFoundException || $exception instanceof NotFoundHttpException) {
            if ($request->is('admin/*')) {
                return redirect()->route('login.admin');
            } elseif ($request->is('siswa/*')) {
                return redirect()->route('login.siswa');
            }
        }

        return parent::render($request, $exception);
    }
}
