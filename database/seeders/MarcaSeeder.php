<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Marca;


class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         $marcas = [
            'Toyota',
            'Honda',
            'Nissan',
            'Hyundai',
            'Kia',
            'Ford',
            'Chevrolet',
            'BMW',
        ];

        foreach ($marcas as $marca) {
            Marca::create([
                'nombre' => $marca
            ]);
        }
    }
}
