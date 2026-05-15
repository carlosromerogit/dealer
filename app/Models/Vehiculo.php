<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehiculo extends Model
{
    protected $table = 'vehiculos';

    protected $fillable = [
        'placa',
        'modelo_id',
        'color_id',
        'anio',
        'precio_lista',
        'estado',
        ];



    protected function casts(): array
    {
        return [
            'precio_lista' => 'decimal:2',
        ];
    }

    public function venta(): HasOne
    {
        return $this->hasOne(Venta::class);
    }


       public function modelo() {
        return $this->belongsTo(Modelo::class);
    }

    public function color() {
        return $this->belongsTo(Color::class);
    }

    public function getNombreCompletoAttribute()
{
    return $this->modelo->marca->nombre . ' ' . $this->modelo->nombre . " - " . $this->placa;
}
}
