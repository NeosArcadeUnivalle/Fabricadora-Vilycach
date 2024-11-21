<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';  
    protected $primaryKey = 'idProducto'; 
    public $timestamps = false;
    protected $fillable = ['nombreProducto', 'cantidadDisponible', 'precio', 'idTipoLadrillo'];

    public function tipoLadrillo()
    {
        return $this->belongsTo(TipoLadrillo::class, 'idTipoLadrillo', 'idTipoLadrillos');
    }
}