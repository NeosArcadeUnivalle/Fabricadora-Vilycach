<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LugarDeVenta extends Model
{
    use HasFactory;

    protected $table = 'lugaresdeventa'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'idLugarVenta'; // Clave primaria de la tabla

    public $timestamps = false; // Si tu tabla no usa timestamps

    // Definir los campos que se pueden llenar masivamente
    protected $fillable = ['nombreLugarVenta', 'direccion', 'ciudad'];
}