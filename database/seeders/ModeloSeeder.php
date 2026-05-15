<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Modelo;
use App\Models\Marca;

class ModeloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         $toyota = Marca::where('nombre', 'Toyota')->first();
        $honda = Marca::where('nombre', 'Honda')->first();
        $nissan = Marca::where('nombre', 'Nissan')->first();

        $modelos = [
            ['marca_id' => $toyota->id, 'nombre' => 'Corolla'],
            ['marca_id' => $toyota->id, 'nombre' => 'Hilux'],
            ['marca_id' => $toyota->id, 'nombre' => 'Yaris'],

            ['marca_id' => $honda->id, 'nombre' => 'Civic'],
            ['marca_id' => $honda->id, 'nombre' => 'CR-V'],

            ['marca_id' => $nissan->id, 'nombre' => 'Sentra'],
            ['marca_id' => $nissan->id, 'nombre' => 'Frontier'],
        ];

        foreach ($modelos as $modelo) {
            Modelo::create($modelo);
        }
    }
}
