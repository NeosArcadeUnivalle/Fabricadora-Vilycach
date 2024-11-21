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

    protected $table = 'empleados'; 
    public $timestamps = false; 
    protected $primaryKey = 'idEmpleado'; 
    protected $fillable = ['correoElectronico', 'password', 'puesto', 'fechaContratacion', 'idPersona'];

    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class, 'idPersona', 'idPersona');
    }
}