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
        // $productos = Producto::with('categoria')->get();
        $productos = Producto::with('categoria', 'imagenes')->get();
        $productos->each(function ($producto) {
            $producto->imagenes->each(function ($imagen) {
                $imagen->url_imagen = url('storage/' . $imagen->url_imagen);
            });
        });
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


    //metodos antes de añadir lo de imagenes (funcionaba bien sin imagenes)
    // //crear 
    // public function store(ProductoRequest $request)
    // {
    //     $producto = Producto::create($request->validated());
    //     return response()->json($producto, 201);
    // }

    // //modificar
    // public function update(ProductoRequest $request, $id)
    // {
    //     $producto = Producto::find($id);
    //     if (!$producto) {
    //         return response()->json(['error' => 'producto no encontrado'], 404);
    //     }

    //     $producto->update($request->validated());
    //     return response()->json($producto);
    // }


    //crear 
    public function store(ProductoRequest $request)
    {
        //crea un nuevo producto
        $producto = Producto::create($request->validated());
        if ($request->hasFile('imagenes')) {
            $imagenes = $request->file('imagenes');

            if (!is_array($imagenes)) {
                $imagenes = [$imagenes];
            }
            foreach ($imagenes as $imagen) {
                $ruta = $imagen->store('productos', 'public');
                $producto->imagenes()->create(['url_imagen' => $ruta]);
            }
        }
        return response()->json($producto->load('imagenes'), 201);
    }

    //modificar
    public function update(ProductoRequest $request, $id)
    {
        $producto = Producto::find($id);
        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }
        $producto->update($request->validated());
        if ($request->hasFile('imagenes')) {
            $imagenes = $request->file('imagenes');
            $imagenes = is_array($imagenes) ? $imagenes : [$imagenes];
            foreach ($imagenes as $imagen) {
                $ruta = $imagen->store('productos', 'public');
                $producto->imagenes()->create(['url_imagen' => $ruta]);
            }
        }
        return response()->json($producto->load('imagenes'), 200);
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
