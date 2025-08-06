<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $fillable = [
        'consecutivo',
        'fecha',
        'cliente_id',
        'vendedor_id',
        'total',
        'estado'
    ];

    protected $casts = [
        'fecha' => 'date',
        'total' => 'decimal:2'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function vendedor()
    {
        return $this->belongsTo(User::class, 'vendedor_id');
    }

    public function items()
    {
        return $this->hasMany(FacturaItem::class);
    }

    public function cartera()
    {
        return $this->hasOne(Cartera::class);
    }
} 