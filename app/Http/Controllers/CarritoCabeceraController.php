<?php

namespace App\Http\Controllers;

use App\Models\CarritoCabecera;
use App\Models\CarritoDetalle;
use App\Models\Producto;
use Illuminate\Http\Request;

class CarritoCabeceraController extends Controller
{
    //obtener el carrito activo del usuario
    public function show(Request $request)
    {
        $user = $request->user();  

        if (!$user) {
            return response()->json(['error' => 'No se pudo autenticar al usuario.'], 401);
        }

        $userId = $user->id;  
        $carrito = CarritoCabecera::with('detalles.producto')
            ->where('id_user', $userId)
            ->firstOrCreate(['id_user' => $userId], ['fecha' => now(), 'precio_total' => 0]);


        return response()->json($carrito);
    }



    //comprar el carrito (vaciarlo después de procesar la compra)
    public function checkout(Request $request)
    {
        $userId = $request->user()->id;
        $carrito = CarritoCabecera::where('id_user', $userId)->first();

        if (!$carrito) {
            return response()->json(['error' => 'No hay un carrito activo'], 404);
        }

        //si quisieramos hacer la lógica para procesar la compra debería ir acá

        $carrito->detalles()->delete(); //eliminar los detalles del carrito
        $carrito->delete(); //eliminar el carrito

        return response()->json(['message' => 'compra realizada con éxito'], 200);
    }
}
