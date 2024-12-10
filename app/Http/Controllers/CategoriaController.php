<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\JsonResponse;

class CategoriaController extends Controller
{
    //
    public function index(): JsonResponse
    {
        $categorias = Categoria::all();
        return response()->json($categorias);
    }
}
