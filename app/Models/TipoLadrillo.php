<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoLadrillo extends Model
{
    use HasFactory;

    protected $table = 'tiposladrillos';  // Nombre de la tabla en la base de datos
    protected $primaryKey = 'idTipoLadrillos';  // Clave primaria de la tabla

    // Desactivamos timestamps porque la tabla no los tiene
    public $timestamps = false;

    // Definir los campos que se pueden llenar masivamente
    protected $fillable = ['tipoLadrillo'];

    // Relación inversa con productos
    public function productos()
    {
        return $this->hasMany(Producto::class, 'idTipoLadrillo', 'idTipoLadrillos');
    }
}