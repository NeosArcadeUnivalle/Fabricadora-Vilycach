<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoLadrillo extends Model
{
    use HasFactory;

    protected $table = 'tiposladrillos';  
    protected $primaryKey = 'idTipoLadrillos';  
    public $timestamps = false;
    protected $fillable = ['tipoLadrillo'];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'idTipoLadrillo', 'idTipoLadrillos');
    }
}