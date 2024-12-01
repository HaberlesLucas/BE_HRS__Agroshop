<?php

namespace Database\Seeders;

use App\Models\Rol;
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
        $roles = [
            ['nombre_rol' => 'administrador'],
            ['nombre_rol' => 'vendedor'],
            ['nombre_rol' => 'cliente'],
        ];

        Rol::insert($roles);
    }
}
