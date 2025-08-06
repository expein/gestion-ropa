<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cartera extends Model
{
    use HasFactory;

    protected $table = 'cartera';

    protected $fillable = [
        'cliente_id',
        'factura_id',
        'valor_total',
        'valor_pendiente'
    ];

    protected $casts = [
        'valor_total' => 'decimal:2',
        'valor_pendiente' => 'decimal:2'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function factura()
    {
        return $this->belongsTo(Factura::class);
    }

    public function abonos()
    {
        return $this->hasMany(Abono::class);
    }
} 