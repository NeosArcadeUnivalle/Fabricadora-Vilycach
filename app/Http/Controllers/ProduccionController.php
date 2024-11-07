<?php

namespace App\Http\Controllers;

use App\Models\Produccion;
use App\Models\Producto;
use App\Models\Empleado;
use Illuminate\Http\Request;

class ProduccionController extends Controller
{
    public function index(Request $request)
    {
        $query = Produccion::with('producto.tipoLadrillo', 'empleadoResponsable.persona');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('producto', function ($q) use ($search) {
                $q->where('nombreProducto', 'like', "%$search%");
            })->orWhereHas('empleadoResponsable.persona', function ($q) use ($search) {
                $q->where('nombre', 'like', "%$search%")
                  ->orWhere('apellido', 'like', "%$search%");
            });
        }

        $producciones = $query->paginate(7);

        return view('produccion.index', compact('producciones'));
    }

    public function create()
    {
        $productos = Producto::with('tipoLadrillo')->get();
        $empleados = Empleado::with('persona')->get();
        return view('produccion.create', compact('productos', 'empleados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date|before_or_equal:today',
            'cantidadProducida' => 'required|numeric|min:1',
            'idProducto' => 'required|exists:productos,idProducto',
            'idEmpleadoResponsable' => 'required|exists:empleados,idEmpleado',
        ]);

        $produccion = new Produccion();
        $produccion->fecha = $request->fecha;
        $produccion->cantidadProducida = $request->cantidadProducida;
        $produccion->idProducto = $request->idProducto;
        $produccion->idEmpleadoResponsable = $request->idEmpleadoResponsable;

        $producto = Producto::find($request->idProducto);
        $producto->cantidadDisponible += $request->cantidadProducida;
        $producto->save();

        $produccion->save();

        return redirect()->route('produccion.index')->with('success', 'Producción creada correctamente');
    }

    public function edit($id)
    {
        $produccion = Produccion::findOrFail($id);
        $productos = Producto::with('tipoLadrillo')->get();
        $empleados = Empleado::with('persona')->get();
        return view('produccion.edit', compact('produccion', 'productos', 'empleados'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha' => 'required|date|before_or_equal:today',
            'cantidadProducida' => 'required|numeric|min:1',
            'idEmpleadoResponsable' => 'required|exists:empleados,idEmpleado',
        ]);

        $produccion = Produccion::findOrFail($id);
        $producto = Producto::find($produccion->idProducto);
        $producto->cantidadDisponible -= $produccion->cantidadProducida;

        $produccion->fecha = $request->fecha;
        $produccion->cantidadProducida = $request->cantidadProducida;
        $produccion->idEmpleadoResponsable = $request->idEmpleadoResponsable;

        $producto->cantidadDisponible += $request->cantidadProducida;
        $producto->save();

        $produccion->save();

        return redirect()->route('produccion.index')->with('success', 'Producción actualizada correctamente');
    }

    public function destroy($id)
    {
        $produccion = Produccion::findOrFail($id);
        $producto = Producto::find($produccion->idProducto);
        $producto->cantidadDisponible -= $produccion->cantidadProducida;
        $producto->save();

        $produccion->delete();

        return redirect()->route('produccion.index')->with('success', 'Producción eliminada correctamente');
    }
}