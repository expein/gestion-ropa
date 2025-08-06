<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    use HasFactory;

    protected $table = 'vendedores';

    protected $fillable = [
        'user_id',
        'tasa_comision',
        'comision_total'
    ];

    protected $casts = [
        'tasa_comision' => 'decimal:2',
        'comision_total' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function facturas()
    {
        return $this->hasMany(Factura::class, 'vendedor_id');
    }

    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'vendedor_id');
    }
} 