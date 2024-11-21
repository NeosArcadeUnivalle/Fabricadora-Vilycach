<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BiController extends Controller
{
    public function index()
    {
        $productosMasVendidos = DB::table('ventas')
            ->join('productos', 'ventas.idProducto', '=', 'productos.idProducto')
            ->join('tiposladrillos', 'productos.idTipoLadrillo', '=', 'tiposladrillos.idTipoLadrillos')
            ->select(
                DB::raw('CONCAT(productos.nombreProducto, " (", tiposladrillos.tipoLadrillo, ")") as nombreProducto'),
                DB::raw('SUM(ventas.total) as cantidad_total')
            )
            ->groupBy('productos.nombreProducto', 'tiposladrillos.tipoLadrillo')
            ->orderBy('cantidad_total', 'desc')
            ->get();

        $productosMasSolicitados = DB::table('ventas')
            ->join('productos', 'ventas.idProducto', '=', 'productos.idProducto')
            ->join('tiposladrillos', 'productos.idTipoLadrillo', '=', 'tiposladrillos.idTipoLadrillos')
            ->select(
                DB::raw('CONCAT(productos.nombreProducto, " (", tiposladrillos.tipoLadrillo, ")") as nombreProducto'),
                DB::raw('COUNT(ventas.idVenta) as solicitudes')
            )
            ->groupBy('productos.nombreProducto', 'tiposladrillos.tipoLadrillo')
            ->orderBy('solicitudes', 'desc')
            ->get();

        $ciudadesMasSolicitadas = DB::table('ventas')
            ->join('lugaresdeventa', 'ventas.idLugarVenta', '=', 'lugaresdeventa.idLugarVenta')
            ->select(
                'lugaresdeventa.ciudad',
                DB::raw('COUNT(ventas.idVenta) as cantidad')
            )
            ->groupBy('lugaresdeventa.ciudad')
            ->orderBy('cantidad', 'desc')
            ->get();

        $ventasPorCategoria = DB::table('ventas')
            ->join('productos', 'ventas.idProducto', '=', 'productos.idProducto')
            ->join('tiposladrillos', 'productos.idTipoLadrillo', '=', 'tiposladrillos.idTipoLadrillos')
            ->select(
                'tiposladrillos.tipoLadrillo',
                DB::raw('SUM(ventas.total) as total_ventas')
            )
            ->groupBy('tiposladrillos.tipoLadrillo')
            ->orderBy('total_ventas', 'desc')
            ->get();

        $ingresosPorMes = DB::table('ventas')
            ->select(
                DB::raw('DATE_FORMAT(ventas.fecha, "%Y-%m") as mes'),
                DB::raw('SUM(ventas.precio) as ingresos_totales')
            )
            ->groupBy('mes')
            ->orderBy('mes', 'asc')
            ->get();

        return view('bi.index', compact(
            'productosMasVendidos',
            'productosMasSolicitados',
            'ciudadesMasSolicitadas',
            'ventasPorCategoria',
            'ingresosPorMes'
        ));
    }
}