<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Color;


class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         $colores = [
            'Negro',
            'Blanco',
            'Gris',
            'Rojo',
            'Azul',
            'Plata',
            'Verde',
        ];

        foreach ($colores as $color) {
            Color::create([
                'nombre' => $color
            ]);
        }
    }
}
