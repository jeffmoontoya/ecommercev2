<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['category_name' => 'Electrónica'],
            ['category_name' => 'Ropa'],
            ['category_name' => 'Hogar y Cocina'],
            ['category_name' => 'Libros'],
            ['category_name' => 'Deportes'],
            ['category_name' => 'Belleza'],
            ['category_name' => 'Juguetes'],
            ['category_name' => 'Salud'],
            ['category_name' => 'Automóviles'],
            ['category_name' => 'Jardín'],
        ];

        DB::table('categories')->insert($categorias);
    }
}
