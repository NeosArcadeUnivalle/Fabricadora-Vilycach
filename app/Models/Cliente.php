<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';  // Nombre de la tabla en la base de datos
    protected $primaryKey = 'idCliente';  // Clave primaria de la tabla

    // Desactivamos timestamps si no tienes columnas `created_at` y `updated_at`
    public $timestamps = false;

    // Definir los campos que se pueden llenar masivamente
    protected $fillable = ['empresa', 'telefono','idPersona'];

    // Relación con el modelo Persona
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'idPersona');
    }
}