<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriaPrima extends Model
{
    // Desactivamos timestamps porque la tabla no los tiene
    public $timestamps = false;

    protected $table = 'materiaprima';
    protected $primaryKey = 'idMaterial';

    protected $fillable = [
        'nombreMateriaPrima', 
        'cantidadDisponible', 
        'fechaUltimaCompra', 
        'idProveedor'
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'idProveedor');
    }
}