<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Venta;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Persona;
use App\Models\LugarDeVenta;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VentaController extends Controller
{
    private function registrarNotificacion($cliente, $producto, $cantidad)
    {
        $fecha = Carbon::now()->format('Y-m-d H:i:s');
        $tipoLadrillo = $producto->tipoLadrillo->tipoLadrillo;
    
        $notificacion = [
            'mensaje' => "{$cliente->persona->nombre} {$cliente->persona->apellido} realizó una solicitud!!! Producto: {$tipoLadrillo} {$producto->nombreProducto} - Cantidad: {$cantidad} - Teléfono: {$cliente->telefono} - {$fecha}",
            'visto' => false, 
        ];
    
        $notificaciones = Storage::exists('notificaciones.json')
            ? json_decode(Storage::get('notificaciones.json'), true)
            : [];
    
        if (!is_array($notificaciones)) {
            $notificaciones = [];
        }
        
        array_unshift($notificaciones, $notificacion);
    
        if (count($notificaciones) > 20) {
            $notificaciones = array_slice($notificaciones, 0, 20);
        }
    
        Storage::put('notificaciones.json', json_encode($notificaciones));
    }

    public function marcarNotificacionesVistas()
    {
    $notificaciones = Storage::exists('notificaciones.json')
        ? json_decode(Storage::get('notificaciones.json'), true)
        : [];

    if (is_array($notificaciones)) {
        foreach ($notificaciones as &$notificacion) {
            $notificacion['visto'] = true;
        }
    }

    Storage::put('notificaciones.json', json_encode($notificaciones));

    return redirect()->route('notificaciones.index')->with('success', 'Todas las notificaciones han sido marcadas como vistas.');
    }

    public function verNotificaciones()
    {
        $notificaciones = Storage::exists('notificaciones.json')
            ? json_decode(Storage::get('notificaciones.json'), true)
            : [];

        return view('ventas.notificaciones', compact('notificaciones'));
    }

    public function create(Request $request)
    {
        $productos = Producto::with('tipoLadrillo')->get();
        $productoSeleccionado = null;
        $cantidadSeleccionada = 1;
        if ($request->has('producto_id') && $request->has('cantidad')) {
            $productoSeleccionado = Producto::find($request->input('producto_id'));
            $cantidadSeleccionada = (int) $request->input('cantidad');
        }
        return view('ventas.create', compact('productos', 'productoSeleccionado', 'cantidadSeleccionada'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/|max:100',
            'apellido' => 'required|string|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/|max:100',
            'empresa' => 'nullable|string|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/|max:100',
            'telefono' => 'required|digits:8',
            'producto' => 'required|integer',
            'cantidad' => 'required|integer|min:1|max:999999',
            'nombreLugarVenta' => 'required|string|max:100',
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:100',
        ]);
        $persona = Persona::firstOrCreate([
            'nombre' => $request->input('nombre'),
            'apellido' => $request->input('apellido')
        ]);
        $cliente = Cliente::firstOrCreate([
            'idPersona' => $persona->idPersona
        ], [
            'empresa' => $request->input('empresa', 'Ninguna'),  
            'telefono' => $request->input('telefono')
        ]);
        $lugarVenta = LugarDeVenta::create([
            'nombreLugarVenta' => $request->input('nombreLugarVenta'),
            'direccion' => $request->input('direccion'),
            'ciudad' => $request->input('ciudad')
        ]);
        $producto = Producto::findOrFail($request->input('producto'));
        $cantidad = $request->input('cantidad');
        $precioUnitario = $producto->precio;
        $precioTotal = $cantidad * $precioUnitario; 
        $venta = Venta::create([
            'idCliente' => $cliente->idCliente,
            'idLugarVenta' => $lugarVenta->idLugarVenta,
            'idProducto' => $producto->idProducto,
            'nombreProducto' => $producto->nombreProducto,
            'precio' => $precioTotal,
            'total' => $cantidad,
            'tipoLadrillo' => $producto->tipoLadrillo->tipoLadrillo,
            'fecha' => Carbon::now(),
            'estado' => 'En espera',
        ]);        
        $this->registrarNotificacion($cliente, $producto, $cantidad);
        if ($venta) {
            return redirect()->back()->with('success', 'Compra registrada exitosamente, espera a que un encargado se comunique con usted.');
        } else {
            return redirect()->back()->with('error', 'Hubo un problema al registrar la venta.');
        }
    }

    public function index(Request $request)
    {
        $query = Venta::with('cliente.persona', 'producto', 'lugarVenta');
        if ($request->has('estado') && $request->estado != '') {
            $query->where('estado', $request->estado);
        }
        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('cliente.persona', function ($q) use ($search) {
                $q->where('nombre', 'like', "%$search%")
                  ->orWhere('apellido', 'like', "%$search%");
            });
        }
        $ventas = $query->paginate(5);
        $notificaciones = Storage::exists('notificaciones.json')
            ? json_decode(Storage::get('notificaciones.json'), true)
            : [];
    
        return view('ventas.index', compact('ventas', 'notificaciones'));
    }
    
    public function edit($id)
    {
        $venta = Venta::findOrFail($id);
        if ($venta->estado === 'Completado') {
            return redirect()->route('ventas.index')->with('error', 'No se puede editar una venta completada.');
        }
        $productos = Producto::with('tipoLadrillo')->get();

        return view('ventas.edit', compact('venta', 'productos'));
    }
    
    public function update(Request $request, $id)
    {
        $venta = Venta::findOrFail($id);
        if ($venta->estado === 'Completado') {
            return redirect()->route('ventas.index')->with('error', 'No se puede editar una venta completada.');
        }
        $request->validate([
            'idProducto' => 'required|integer|exists:productos,idProducto',
            'cantidad' => 'required|integer|min:1',
        ]);
        $producto = Producto::findOrFail($request->input('idProducto'));
        $cantidad = $request->input('cantidad');
        $precioTotal = $producto->precio * $cantidad;
        $venta->idProducto = $producto->idProducto;
        $venta->nombreProducto = $producto->nombreProducto;
        $venta->precio = $precioTotal;  
        $venta->total = $cantidad;  
        $venta->tipoLadrillo = $producto->tipoLadrillo->tipoLadrillo; 
        $venta->save();
        return redirect()->route('ventas.index')->with('success', 'Venta actualizada exitosamente.');
    }
    
    public function updateEstado($id)
    {
        $venta = Venta::findOrFail($id);
        $productoId = $venta->idProducto;
        $cantidadRestante = $venta->total;
    
        // FIFO
        $lotes = \DB::table('productos')
            ->join('materiaprima', 'productos.idProducto', '=', 'materiaprima.idMaterial')
            ->where('productos.idProducto', $productoId)
            ->orderBy('materiaprima.fechaUltimaCompra', 'asc') // ORDENAR
            ->select('productos.idProducto', 'productos.cantidadDisponible', 'materiaprima.fechaUltimaCompra')
            ->get();

        foreach ($lotes as $lote) {
            if ($cantidadRestante <= 0) {
                break;
            }
            if ($lote->cantidadDisponible >= $cantidadRestante) {
                \DB::table('productos')
                    ->where('idProducto', $lote->idProducto)
                    ->update(['cantidadDisponible' => $lote->cantidadDisponible - $cantidadRestante]);
                $cantidadRestante = 0;
            } else {
                $cantidadRestante -= $lote->cantidadDisponible;
                \DB::table('productos')
                    ->where('idProducto', $lote->idProducto)
                    ->update(['cantidadDisponible' => 0]);
            }
        }
        if ($cantidadRestante > 0) {
            return redirect()->route('ventas.index')->withErrors(['error' => 'No hay suficiente stock para completar esta venta.']);
        }
        $venta->estado = 'Completado';
        $venta->save();
    
        return redirect()->route('ventas.index')->with('success', 'Venta completada correctamente.');
    }
    

    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);
        $venta->delete();

        return redirect()->route('ventas.index')->with('success', 'Venta eliminada exitosamente.');
    }
}