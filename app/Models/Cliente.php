<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';  
    protected $primaryKey = 'idCliente';  
    public $timestamps = false;
    protected $fillable = ['empresa', 'telefono','idPersona'];
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'idPersona');
    }
}