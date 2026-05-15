<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pago extends Model
{
     protected $fillable = [
        'financiamiento_id',
        'monto',
        'fecha_pago',
    ];

    public function financiamiento():BelongsTo
    {
        return $this->belongsTo(Financiamiento::class);
    }
}
