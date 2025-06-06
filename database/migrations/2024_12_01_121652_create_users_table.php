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
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('password');
            $table->string('email')->unique();
            $table->string('usuario');
            $table->boolean('estado')->default(1);
            $table->rememberToken();

            $table->unsignedBigInteger('rol_id')->default(3); //campo para la clave foranea de la tabla->rols
            //def de la FK para 'rol_id'. referenciando 'id_rol' en la talba 'rols'
            $table->foreign('rol_id')->references('id_rol')->on('rols');
            $table->timestamps();


            // $table->timestamp('email_verified_at')->nullable();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
