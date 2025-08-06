<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abono extends Model
{
    use HasFactory;

    protected $fillable = [
        'cartera_id',
        'valor',
        'fecha'
    ];

    protected $casts = [
        'fecha' => 'date',
        'valor' => 'decimal:2'
    ];

    public function cartera()
    {
        return $this->belongsTo(Cartera::class);
    }
} 