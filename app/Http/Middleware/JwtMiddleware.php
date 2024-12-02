<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JwtMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            //intenta autenticar al usuario con el token JWT
            $user = JWTAuth::parseToken()->authenticate();

            if (!$user) {
                return response()->json(['error' => 'usuario no encontrado.'], 404);
            }

            Auth::setUser($user);   
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token no recibido / inválido / vencido.'], 401);
        }

        return $next($request);
    }
}
