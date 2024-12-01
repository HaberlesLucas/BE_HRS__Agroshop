<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['nombre_categoria' => 'Alimentos para Animales'],
            ['nombre_categoria' => 'Semillas'],
            ['nombre_categoria' => 'Fertilizantes y Abonos'],
            ['nombre_categoria' => 'Productos para Control de Plagas'],
            ['nombre_categoria' => 'Herramientas y Equipos de Campo'],
            ['nombre_categoria' => 'Medicamentos Veterinarios'],
            ['nombre_categoria' => 'Equipos y Accesorios para Animales'],
            ['nombre_categoria' => 'Materiales para Construcción Rural'],
            ['nombre_categoria' => 'Productos Agroindustriales'],
            ['nombre_categoria' => 'Ropa y Calzado de Trabajo'],
        ];

        Categoria::insert($categorias);
    }
}
