<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vendedor extends Model
{
    protected $table = 'vendedores';
    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'comision_pct',
        'activo',
    ];

    protected function casts(): array
    {
        return [
            'comision_pct' => 'decimal:2',
            'activo' => 'boolean',
        ];
    }


    public function ventas(): HasMany
    {
        return $this->hasMany(Venta::class);
    }
}
