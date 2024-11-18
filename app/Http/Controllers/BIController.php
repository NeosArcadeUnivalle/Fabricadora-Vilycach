<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BiController extends Controller
{
    public function index()
    {
        // Productos más vendidos (cantidad total adquirida)
        $productosMasVendidos = DB::table('ventas')
            ->join('productos', 'ventas.idProducto', '=', 'productos.idProducto')
            ->join('tiposladrillos', 'productos.idTipoLadrillo', '=', 'tiposladrillos.idTipoLadrillos')
            ->select(
                'productos.nombreProducto',
                'tiposladrillos.tipoLadrillo',
                DB::raw('SUM(ventas.total / productos.precio) as cantidad_total')
            )
            ->groupBy('productos.nombreProducto', 'tiposladrillos.tipoLadrillo')
            ->orderBy('cantidad_total', 'desc')
            ->limit(10)
            ->get();

        // Ciudades con más solicitudes
        $ciudadesMasSolicitadas = DB::table('ventas')
            ->join('lugaresdeventa', 'ventas.idLugarVenta', '=', 'lugaresdeventa.idLugarVenta')
            ->select(
                'lugaresdeventa.ciudad',
                DB::raw('COUNT(ventas.idVenta) as cantidad')
            )
            ->groupBy('lugaresdeventa.ciudad')
            ->orderBy('cantidad', 'desc')
            ->limit(5)
            ->get();

        // Solicitudes por producto
        $productosMasSolicitados = DB::table('ventas')
            ->join('productos', 'ventas.idProducto', '=', 'productos.idProducto')
            ->join('tiposladrillos', 'productos.idTipoLadrillo', '=', 'tiposladrillos.idTipoLadrillos')
            ->select(
                'productos.nombreProducto',
                'tiposladrillos.tipoLadrillo',
                DB::raw('COUNT(ventas.idVenta) as solicitudes')
            )
            ->groupBy('productos.nombreProducto', 'tiposladrillos.tipoLadrillo')
            ->orderBy('solicitudes', 'desc')
            ->limit(10)
            ->get();

        return view('bi.index', compact('productosMasVendidos', 'ciudadesMasSolicitadas', 'productosMasSolicitados'));
    }
}