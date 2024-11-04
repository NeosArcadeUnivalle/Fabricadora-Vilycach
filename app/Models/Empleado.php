<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Empleado extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable;
    protected $table = 'empleados'; // Nombre de la tabla en la base de datos
    public $timestamps = false; // Si tu tabla no usa timestamps
    protected $primaryKey = 'idEmpleado'; // Llave primaria

    protected $fillable = ['correoElectronico', 'password', 'puesto', 'fechaContratacion', 'idPersona'];

    // Relación con Persona
    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class, 'idPersona', 'idPersona');
    }
}