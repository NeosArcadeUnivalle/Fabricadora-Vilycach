<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $table = 'personas'; // Nombre de la tabla en la base de datos
    // Desactivar timestamps si no los usas en tu tabla
    public $timestamps = false;
    protected $primaryKey = 'idPersona'; // Llave primaria

    protected $fillable = [
        'nombre',
        'apellido',
    ];

    // Relación con el modelo Empleado (una persona puede ser asociada a varios empleados)
    public function empleados(): HasMany
    {
        return $this->hasMany(Empleado::class, 'idPersona', 'idPersona');
    }
}