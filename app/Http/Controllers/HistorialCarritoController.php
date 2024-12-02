<?php

namespace App\Http\Controllers;

use App\Models\CarritoCabecera;
use App\Models\CarritoDetalle;
use App\Models\HistorialCarritoCabecera;
use App\Models\HistorialCarritoDetalle;
use Illuminate\Http\Request;

class HistorialCarritoController extends Controller
{

    public function index(Request $request)
    {
        //autenticado
        $id_user = $request->user()->id_user;

        //obtener todos los registros del historial de carritos para el usuario autenticado
        $historialCarritos = HistorialCarritoCabecera::where('id_user', $id_user)
            ->with('detalles')
            ->get();
        return response()->json($historialCarritos);
    }

    //obtener solo un carrito historial especiffico 
    public function show($id_historial)
    {
        $historialCarrito = HistorialCarritoCabecera::with('detalles')
            ->where('id', $id_historial)
            ->firstOrFail();
        return response()->json($historialCarrito);
    }


    public function finalizarCompra(Request $request)
    {
        $id_user = $request->user()->id_user;

        //obtener el carrito actual del usuario
        $carrito = CarritoCabecera::where('id_user', $id_user)->first();

        if ($carrito) {
            //crear una nueva cabecera en el historial
            $historialCabecera = HistorialCarritoCabecera::create([
                'id_user' => $id_user,
                'fecha' => now(),
                'precio_total' => $carrito->precio_total,
            ]);

            //obtener los detalles del carrito
            $carritoDetalles = CarritoDetalle::where('id_carrito_cb', $carrito->id_carrito_cb)->get();

            //guardar los detalles en el historial
            foreach ($carritoDetalles as $detalle) {
                HistorialCarritoDetalle::create([
                    'id_historial_cb' => $historialCabecera->id,
                    'id_producto' => $detalle->id_producto,
                    'cantidad' => $detalle->cantidad,
                    'precio_unitario' => $detalle->precio_unitario,
                ]);
            }

            //eliminar el carrito actual
            $carrito->detalles()->delete();
            $carrito->delete();

            return response()->json(['message' => 'Compra finalizada y carrito movido al historial'], 200);
        }

        return response()->json(['message' => 'No se encontró el carrito'], 404);
    }
}
