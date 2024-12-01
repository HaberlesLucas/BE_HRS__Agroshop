<?php

namespace App\Http\Controllers;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class LoginController extends Controller
{
    // $credenciales = $request->only('email', 'password');
    public function login(Request $request)
    {

        $field = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'usuario';

        $credenciales = [
            $field => $request->input($field), 
            'password' => $request->password,
        ];

        try {
            if (!$token = JWTAuth::attempt($credenciales)) {
                return response()->json(['error' => 'usuario no autorizado'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'no se pudo crear el token'], 500);
        }

        return response()->json(compact('token'));
    }

    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['message' => 'Successfully logged out']);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed to logout'], 500);
        }
    }
}
