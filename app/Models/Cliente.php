<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'cedula',
        'direccion',
        'zona',
        'vendedor_id',
        'telefono'
    ];

    public function vendedor()
    {
        return $this->belongsTo(User::class, 'vendedor_id');
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