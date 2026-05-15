<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Financiamiento extends Model
{
      protected $table = 'financiamientos';

      protected $fillable = [
        'venta_id',
        'entidad_bancaria',
        'enganche',
        'monto_financiado',
        'num_cuotas',
        'tasa_interes',
        'fecha_aprobacion',
        'estado',
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }

    public function getTotalAttribute()
    {
        return $this->monto_financiado +
            ($this->monto_financiado * $this->tasa_interes / 100);
    }

    public function getCuotaMensualAttribute()
    {
        return $this->total / $this->num_cuotas;
    }

    // 💸 TOTAL PAGADO
    public function getTotalPagadoAttribute()
    {
        return $this->pagos->sum('monto');
    }

    public function getSaldoAttribute()
    {
        return $this->total - $this->total_pagado;
    }

public function getEstadoAttribute($value)
{
    if ($this->saldo <= 0) {
        return 'pagado';
    }

    return $value;
}
    public function getProgresoAttribute()
{
    if ($this->total == 0) {
        return 0;
    }

    return round(($this->total_pagado / $this->total) * 100, 2);
}
}
