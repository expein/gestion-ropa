<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'foto',
        'precio',
        'stock'
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'stock' => 'integer'
    ];

    public function facturaItems()
    {
        return $this->hasMany(FacturaItem::class);
    }
} 