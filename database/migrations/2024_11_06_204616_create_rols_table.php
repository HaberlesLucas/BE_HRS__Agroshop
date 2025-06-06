<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rols', function (Blueprint $table) {
            $table->id('id_rol');
            $table->string('nombre_rol');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('rols');
    }
};
