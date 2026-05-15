<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'nombre',
        'cedula',
        'telefono',
        'email',
        'direccion',
    ];

    public function ventas(): HasMany
    {
        return $this->hasMany(Venta::class);
    }
}
