<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */

    public function render($request, Throwable $exception)
    {
        // Принудительное ожидание JSON для всех API-запросов
        if ($request->is('api/*') || $request->expectsJson()) {
            // Обработка ошибок валидации
            if ($exception instanceof \Illuminate\Validation\ValidationException) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ошибка валидации',
                    'errors' => $exception->errors(),
                ], 422);
            }

            // Обработка ошибок аутентификации
            if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthenticated',
                ], 401);
            }

            // Обработка ошибок авторизации
            if ($exception instanceof \Illuminate\Auth\Access\AuthorizationException) {
                return response()->json([
                    'success' => false,
                    'message' => 'Forbidden',
                ], 403);
            }

            // Обработка любых других ошибок
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ], 500);
        }

        // Возвращаем поведение по умолчанию для не-API-запросов
        return parent::render($request, $exception);
    }
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
}
