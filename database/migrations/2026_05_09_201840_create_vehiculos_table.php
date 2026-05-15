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
        Schema::create('vehiculos', function (Blueprint $table) {

            $table->dropColumn(['marca', 'modelo', 'color']);

            $table->id();
            $table->string('placa')->unique();
            $table->string('vin')->unique()->nullable();
            $table->string('marca');
            $table->string('modelo');
            $table->year('anio');
            $table->string('color');
            $table->decimal('precio_lista', 12, 2);
            $table->enum('estado', [
                'disponible',
                'reservado',
                'vendido'
            ])->default('disponible');

              $table->foreignId('modelo_id')->constrained();
            $table->foreignId('color_id')->constrained('colores');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
