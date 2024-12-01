<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UsuarioRequest;


class UserController extends Controller
{
    //mostrar todos los usuarios 
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }


    //mostrar usuario filtrado por id_user
    public function show(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'usuario no encontrado'], 404);
        }
        return response()->json($user);
    }

    //crear un usuario 
    public function store(UsuarioRequest $usuarioRequest)
    {
        $rol_id = $usuarioRequest->rol_id ?: 3;
        // dd("holaaa");

        $user = User::create([
            'nombre' => $usuarioRequest->nombre,
            'apellido' => $usuarioRequest->apellido,
            'email' => $usuarioRequest->email,
            'usuario' => $usuarioRequest->usuario,
            'estado' => 1,
            'password' => Hash::make($usuarioRequest->password),
            'rol_id' => $rol_id,
        ]);

        return response()->json([
            'message' => 'Usuario creado correctamente',
            'user' => $user
        ], 201);
    }



    public function update(UsuarioRequest $request, $id)
    {
        //buscar recibido usuario
        $user = User::find($id);

        //si usuario buscado no existe:
        if (!$user) {
            return response()->json(['message' => 'usuario no encontrado'], 404);
        }

        //actualizar los campos proporcionados
        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;
        $user->email = $request->email;

        //actualizar rol solo si recibe 
        if ($request->has('rol_id')) {
            $user->rol_id = $request->rol_id;
        }

        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
        // return response()->json($user, 200);
        return response()->json([
            'message' => 'usuario actualizado correctamente',
            'user' => $user
        ], 200);
    }


    public function destroy($id)
    {
        //buscar recibido usuario
        $user = User::find($id);

        //si no existe:
        if (!$user) {
            return response()->json(['message' => 'usuario no encontrado'], 404);
        }

        //eliminar al usuario recibido/encontrado
        $user->delete();

        return response()->json(['message' => 'usuario eliminado correctamente'], 200);
    }
}
