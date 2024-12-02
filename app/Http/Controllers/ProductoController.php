<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoRequest;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    //obtener todos 
    public function index()
    {
        $productos = Producto::with('categoria')->get();
        return response()->json($productos);
    }

    //obtener uno 
    public function show($id_producto)
    {
        $producto = Producto::with('categoria')->find($id_producto);
        if (!$producto) {
            return response()->json(['error' => 'producto no encontrado'], 404);
        }
        return response()->json($producto);
    }

    //crear 
    public function store(ProductoRequest $request)
    {
        $producto = Producto::create($request->validated());
        return response()->json($producto, 201);
    }

    //modificar
    public function update(ProductoRequest $request, $id)
    {
        $producto = Producto::find($id);
        if (!$producto) {
            return response()->json(['error' => 'producto no encontrado'], 404);
        }

        $producto->update($request->validated());
        return response()->json($producto);
    }

    //eliminar 
    public function destroy($id)
    {
        $producto = Producto::find($id);
        if (!$producto) {
            return response()->json(['error' => 'producto no encontrado'], 404);
        }

        $producto->delete();
        return response()->json(['message' => 'producto eliminado correctamente']);
    }
}
