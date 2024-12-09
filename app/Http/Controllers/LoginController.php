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

            $user = auth()->user();


            $response = [
                'token' => $token,
                'user' => [
                    'id_user' => $user->id_user,
                    'rol_id' => $user->rol_id,
                    'nombre' => $user->nombre,
                    'apellido' => $user->apellido,
                    'usuario' => $user->usuario,
                    'email' => $user->email,

                ]
            ];
            // dd($response);
            // return token y los datos del usuario
            return response()->json($response);
        } catch (JWTException $e) {
            return response()->json(['error' => 'no se pudo crear el token'], 500);
        }
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
