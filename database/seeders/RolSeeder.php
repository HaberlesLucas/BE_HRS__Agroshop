<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //al ejecutar: "php artisan db:seed" se crearán estos roles, 
        //se lo debe hacer luego de las migraciones, o 'fresh' migrations   
        DB::table('rols')->insert([
            ['id_rol' => 1, 'nombre_rol' => 'administrador'],
            ['id_rol' => 2, 'nombre_rol' => 'vendedor'],
            ['id_rol' => 3, 'nombre_rol' => 'cliente'],
        ]);
    }
}
