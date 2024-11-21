<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $table = 'personas'; 
    public $timestamps = false;
    protected $primaryKey = 'idPersona'; 

    protected $fillable = [
        'nombre',
        'apellido',
    ];

    public function empleados(): HasMany
    {
        return $this->hasMany(Empleado::class, 'idPersona', 'idPersona');
    }
}