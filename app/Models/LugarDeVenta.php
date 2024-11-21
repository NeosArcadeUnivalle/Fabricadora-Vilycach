<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LugarDeVenta extends Model
{
    use HasFactory;

    protected $table = 'lugaresdeventa'; 
    protected $primaryKey = 'idLugarVenta';
    public $timestamps = false; 
    protected $fillable = ['nombreLugarVenta', 'direccion', 'ciudad'];
}