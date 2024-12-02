<?php

namespace App\Http\Controllers;

use App\Models\CarritoCabecera;
use App\Models\CarritoDetalle;
use App\Models\Producto;
use Illuminate\Http\Request;

class CarritoDetalleController extends Controller
{
    //añadir un producto al carrito
    public function store(Request $request)
    {
        $request->validate([
            'productos' => 'required|array',
            'productos.*.id_producto' => 'required|exists:productos,id_producto',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        $id_user = $request->user()->id_user;

        foreach ($request->productos as $productoData) {
            $producto = Producto::findOrFail($productoData['id_producto']);
            $carrito = CarritoCabecera::firstOrCreate(
                ['id_user' => $id_user],
                ['fecha' => now(), 'precio_total' => 0]
            );

            //verificar si el producto ya esta en el carrito
            $detalle = CarritoDetalle::where('id_carrito_cb', $carrito->id_carrito_cb)
                ->where('id_producto', $productoData['id_producto'])
                ->first();

            if ($detalle) {
                $detalle->cantidad += $productoData['cantidad'];
                $detalle->save();
            } else {
                CarritoDetalle::create([
                    'id_carrito_cb' => $carrito->id_carrito_cb,
                    'id_producto' => $productoData['id_producto'],
                    'cantidad' => $productoData['cantidad'],
                    'precio_unitario' => $producto->precio_compra,
                ]);
            }

            //actualizar el precio total del carrito
            $carrito->precio_total = $carrito->detalles()
                ->selectRaw('SUM(cantidad * precio_unitario) as total')
                ->pluck('total')
                ->first();
            $carrito->save();
        }

        return response()->json($carrito->load('detalles.producto'), 201);
    }


    //actualizar la cantidad de un producto en el carrito
    public function update(Request $request, $detalleId)
    {
        $request->validate(['cantidad' => 'required|integer|min:1']);
        $detalle = CarritoDetalle::findOrFail($detalleId);

        $detalle->cantidad = $request->cantidad;
        $detalle->save();

        //actualizar el precio total del carrito
        $detalle->carritoCabecera->precio_total = $detalle->carritoCabecera->detalles()->sumRaw('cantidad * precio_unitario');
        $detalle->carritoCabecera->save();

        return response()->json($detalle->carritoCabecera->load('detalles.producto'));
    }

    //eliminar un producto del carrito
    public function destroy($detalleId)
    {
        $detalle = CarritoDetalle::findOrFail($detalleId);
        $carrito = $detalle->carritoCabecera;

        $detalle->delete();

        //actualizar el precio total del carrito
        $carrito->precio_total = $carrito->detalles()->sumRaw('cantidad * precio_unitario');
        $carrito->save();

        return response()->json($carrito->load('detalles.producto'));
    }
}
