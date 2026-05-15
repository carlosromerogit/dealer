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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->foreignId('vehiculo_id')
            ->unique()
            ->constrained()
            ->cascadeOnDelete();

    $table->foreignId('vendedor_id')
        ->constrained('vendedores')
        ->cascadeOnDelete();

        $table->date('fecha');

        $table->decimal('precio_lista', 12, 2);

        $table->decimal('descuento', 12, 2)
            ->default(0);

        $table->decimal('precio_final', 12, 2);

        $table->enum('tipo_pago', [
            'contado',
            'financiado'
        ]);

        $table->enum('estado', [
            'pendiente',
            'completada',
            'cancelada'
        ])->default('pendiente');

        $table->text('observaciones')
            ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
