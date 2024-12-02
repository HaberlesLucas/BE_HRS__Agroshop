<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('carrito_detalle', function (Blueprint $table) {
            $table->id('id_carrito_dt');
            $table->integer('cantidad');
            $table->double('precio_unitario');

            //campos para relacionar con carrito cabecera y con productos
            $table->unsignedBigInteger('id_carrito_cb');
            $table->unsignedBigInteger('id_producto');

            //relaciones foreaneas 
            $table->foreign('id_carrito_cb')->references('id_carrito_cb')->on('carrito_cabecera')->onDelete('cascade');
            $table->foreign('id_producto')->references('id_producto')->on('productos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carrito_detalle');
    }
};
