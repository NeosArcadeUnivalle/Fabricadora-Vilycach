<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';  // Nombre de la tabla en la base de datos
    protected $primaryKey = 'idProducto';  // Clave primaria de la tabla

    // Desactivamos timestamps porque la tabla no los tiene
    public $timestamps = false;

    // Definir los campos que se pueden llenar masivamente
    protected $fillable = ['nombreProducto', 'cantidadDisponible', 'precio', 'idTipoLadrillo'];

    // Definir la relación con TipoLadrillo
    public function tipoLadrillo()
    {
        return $this->belongsTo(TipoLadrillo::class, 'idTipoLadrillo', 'idTipoLadrillos');
    }
}