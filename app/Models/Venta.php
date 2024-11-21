<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'ventas';
    protected $primaryKey = 'idVenta';
    protected $fillable = [
        'idCliente', 
        'idLugarVenta', 
        'idProducto', 
        'nombreProducto', 
        'precio', 
        'total', 
        'tipoLadrillo', 
        'fecha',
        'estado' 
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'idCliente');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'idProducto');
    }

    public function lugarVenta()
    {
        return $this->belongsTo(LugarDeVenta::class, 'idLugarVenta');
    }
}