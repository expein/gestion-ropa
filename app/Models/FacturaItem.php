<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturaItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'factura_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'subtotal'
    ];

    protected $casts = [
        'cantidad' => 'integer',
        'precio_unitario' => 'decimal:2',
        'subtotal' => 'decimal:2'
    ];

    public function factura()
    {
        return $this->belongsTo(Factura::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
} 