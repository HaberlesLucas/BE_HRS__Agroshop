<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRol
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        //´1ro debemos obtener el usuario autenticado
        $user = $request->user(); 


        //verificar si el rol del usuario está en los roles permitidos
        if (!in_array($user->rol->nombre_rol, $roles)) {
            return response()->json(['error' => 'acceso no autorizado'], 403);
        }

        return $next($request);
    }
}
