<?php

use App\Http\Middleware\CheckRol;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use App\Http\Middleware\JwtMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'jwt' => JwtMiddleware::class, //middleware para JWT
            'role' => CheckRol::class, //middleware para roles
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Usuario no autenticado. Por favor, inicie sesión.',
                ], 401);
            }
        });
        $exceptions->render(function (Exception $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'error' => 'Error interno del servidor: ' . $e->getMessage(),
                ], 500);
            }
        });
    })->create();


   /* Lucas: 1/12/2024
   * lo que incluyo en withExceptions es importante para la validacion en los request
   *  
   */