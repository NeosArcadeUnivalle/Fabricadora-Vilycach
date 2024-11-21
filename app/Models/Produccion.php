<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produccion extends Model
{
    protected $table = 'produccion';
    protected $primaryKey = 'idProduccion'; 

    protected $fillable = [
        'fecha', 
        'cantidadProducida', 
        'idEmpleadoResponsable', 
        'idProducto'
    ];

    public $timestamps = false;

    public function empleadoResponsable()
    {
        return $this->belongsTo(Empleado::class, 'idEmpleadoResponsable', 'idEmpleado');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'idProducto', 'idProducto');
    }
}