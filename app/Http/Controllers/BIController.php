<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BIController extends Controller
{
    public function index()
    {
        $productosMasVendidos = DB::table('ventas')
            ->join('productos', 'ventas.idProducto', '=', 'productos.idProducto')
            ->join('tiposladrillos', 'productos.idTipoLadrillo', '=', 'tiposladrillos.idTipoLadrillos')
            ->select(
                'productos.nombreProducto',
                'tiposladrillos.tipoLadrillo',
                DB::raw('COUNT(ventas.idVenta) as cantidad')
            )
            ->groupBy('productos.nombreProducto', 'tiposladrillos.tipoLadrillo')
            ->orderByDesc('cantidad')
            ->get();

        return view('bi.index', compact('productosMasVendidos'));
    }
}