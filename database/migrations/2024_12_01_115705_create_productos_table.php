<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id('id_producto');
            $table->string('codigo');
            $table->string('nombre');
            $table->string('descripcion');
            $table->integer('stock');
            $table->integer('stock_min')->nullable(true);
            $table->double('precio_compra');
            $table->double('incremento');
            
            $table->unsignedBigInteger('id_categoria'); //campo para la clave foranea de la tabla->categoria
            $table->foreign('id_categoria')->references('id_categoria')->on('categorias');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
