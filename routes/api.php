<?php

use App\Http\Controllers\CarritoCabeceraController;
use App\Http\Controllers\CarritoDetalleController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\HistorialCarritoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//rutas públicas
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth',
], function () {
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout']);
});

//rutas protegidas por JWT y rol
Route::middleware('jwt')->group(function () {


    //rutas solo para administradores
    Route::middleware('role:administrador')->prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/{id}', [UserController::class, 'show']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
    });

    //rutas para admins y vendedores (manejan vendedores y admins los productos)
    Route::middleware('role:vendedor,administrador')->prefix('productos')->group(function () {

        //obtener las cateorias para cargar un nuevo prodcuto
        // Route::get('/categorias', [CategoriaController::class, 'index']);

        // Route::get('/', [ProductoController::class, 'index']);
        // Route::get('/{id}', [ProductoController::class, 'show']);
        Route::post('/', [ProductoController::class, 'store']);
        Route::put('/{id}', [ProductoController::class, 'update']);
        Route::delete('/{id}', [ProductoController::class, 'destroy']);
    });

    //rutas para admins,clientes, y vendedores
    // Route::middleware('role:vendedor,administrador,cliente')->prefix('productos')->group(function () {

    //     //obtener las cateorias para cargar un nuevo prodcuto
    //     Route::get('/categorias', [CategoriaController::class, 'index']);

    //     Route::get('/', [ProductoController::class, 'index']);
    //     Route::get('/{id}', [ProductoController::class, 'show']);
    // });

    //rutas solo para clientes

    Route::middleware('role:cliente')->prefix('carrito')->group(function () {
        //operaciones sobre el carrito
        Route::get('/', [CarritoCabeceraController::class, 'show']);
        Route::post('/checkout', [CarritoCabeceraController::class, 'checkout']);

        //operaciones sobre los detalles del carrito
        Route::post('/detalle', [CarritoDetalleController::class, 'store']);
        Route::put('/detalle/{detalleId}', [CarritoDetalleController::class, 'update']);
        Route::delete('/detalle/{detalleId}', [CarritoDetalleController::class, 'destroy']);

        //finalizar la compra mueve el carrito actual al historial 
        Route::post('/finalizar-compra', [HistorialCarritoController::class, 'finalizarCompra']);


        Route::get('/historial-carrito', [HistorialCarritoController::class, 'index']); //todos
        Route::get('/historial-carrito/{id_historial}', [HistorialCarritoController::class, 'show']); //uno
    });
});


//ruta publica para crear  usuario
Route::post('/users', [UserController::class, 'store']);

//rutas publicas ya que el todos necesitan acceso a estos productos y por ende sus categorias
Route::prefix('productos')->group(function () {
    Route::get('/categorias', [CategoriaController::class, 'index']);
    Route::get('/', [ProductoController::class, 'index']);
    Route::get('/{id}', [ProductoController::class, 'show']);
});
/*
permisos establecidos por el grupo
    decidimos que:
        1. admin haga ABM de usuarios y productos
        2. vendedor solo haga el ABM de productos
        3. cliente realizar compra (agregar productos al carrito y simular compra)
*/