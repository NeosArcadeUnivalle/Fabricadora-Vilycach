<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produccion extends Model
{
    protected $table = 'produccion'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'idProduccion'; // Llave primaria

    protected $fillable = [
        'fecha', 
        'cantidadProducida', 
        'idEmpleadoResponsable', 
        'idProducto'
    ];

    // Deshabilitar timestamps
    public $timestamps = false;

    // Relación con el modelo Empleado (Empleado Responsable)
    public function empleadoResponsable()
    {
        return $this->belongsTo(Empleado::class, 'idEmpleadoResponsable', 'idEmpleado');
    }

    // Relación con el modelo Producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'idProducto', 'idProducto');
    }
}