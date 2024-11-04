<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    // Desactivamos timestamps porque la tabla no los tiene
    public $timestamps = false;
    
    protected $table = 'proveedores';
    protected $primaryKey = 'idProveedor';

    protected $fillable = [
        'nombreProveedor', 
        'telefonoProveedor', 
        'correoElectronicoProveedor', 
        'direccionProveedor'
    ];

    public function materiaPrima()
    {
        return $this->hasMany(MateriaPrima::class, 'idProveedor');
    }
}