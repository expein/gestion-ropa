<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'tipo_documento',
        'numero_documento',
        'email',
        'telefono',
        'direccion',
        'zona',
        'vendedor_id',
        'limite_credito'
    ];

    public function vendedor()
    {
        return $this->belongsTo(Vendedor::class, 'vendedor_id');
    }

    public function facturas()
    {
        return $this->hasMany(Factura::class);
    }

    public function cartera()
    {
        return $this->hasOne(Cartera::class);
    }

    public function abonos()
    {
        return $this->hasMany(Abono::class);
    }
} 