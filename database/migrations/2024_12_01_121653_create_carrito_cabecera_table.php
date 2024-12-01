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
        Schema::create('carrito_cabecera', function (Blueprint $table) {
            $table->id('id_carrito_cb');
            $table->date('fecha');
            $table->double('precio_total');

            //user id foreignkey 
            $table->unsignedBigInteger('id_user'); //campo para la clave foranea de la tabla->users
            
            // $table->foreign('id_user')->references('id_user')->on('users');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carrito_cabecera');
    }
};
