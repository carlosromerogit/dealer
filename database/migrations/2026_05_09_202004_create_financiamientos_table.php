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
        Schema::create('financiamientos', function (Blueprint $table) {
            $table->id();
             $table->foreignId('venta_id')
        ->unique()
        ->constrained()
        ->cascadeOnDelete();

    $table->string('entidad_bancaria');

    $table->decimal('enganche', 12, 2)->default(0);

    $table->decimal('monto_financiado', 12, 2);

    $table->integer('num_cuotas');

    $table->decimal('tasa_interes', 5, 2)->default(0);

    $table->date('fecha_aprobacion')->nullable();

    // 👇 IMPORTANTE PARA NEGOCIO REAL
    $table->string('estado')->default('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financiamientos');
    }
};
