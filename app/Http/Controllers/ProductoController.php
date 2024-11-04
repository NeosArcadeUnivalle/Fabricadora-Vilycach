<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\TipoLadrillo;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $query = Producto::with('tipoLadrillo');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('nombreProducto', 'like', "%$search%");
        }

        $productos = $query->paginate(5);

        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        // Obtener todos los tipos de ladrillos
        $tiposLadrillos = TipoLadrillo::all();
        
        // Mostrar el formulario para crear un nuevo producto
        return view('productos.create', compact('tiposLadrillos'));
    }

    public function store(Request $request)
    {
        // Validar los datos con mensajes personalizados
        $request->validate([
            'nombreProducto' => 'required|string|max:100|regex:/^[a-zA-Z0-9\s]+$/',
            'cantidadDisponible' => 'required|integer|min:0',
            'precio' => 'required|numeric|min:0',
        ]);

        // Si se ingresa un nuevo tipo de ladrillo
        if ($request->filled('nuevoTipoLadrillo')) {
            $nuevoTipo = TipoLadrillo::create(['tipoLadrillo' => $request->nuevoTipoLadrillo]);
            $request->merge(['idTipoLadrillo' => $nuevoTipo->idTipoLadrillos]);
        }

        // Crear un nuevo producto
        Producto::create($request->all());

        // Redirigir al listado de productos
        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }

    public function edit($idProducto)
    {
        // Buscar el producto por su ID
        $producto = Producto::findOrFail($idProducto);

        // Obtener todos los tipos de ladrillos
        $tiposLadrillos = TipoLadrillo::all();

        return view('productos.edit', compact('producto', 'tiposLadrillos'));
    }

    public function update(Request $request, $idProducto)
    {
        // Validar los datos con mensajes personalizados
        $request->validate([
            'nombreProducto' => 'required|string|max:100|regex:/^[a-zA-Z0-9\s]+$/',
            'cantidadDisponible' => 'required|integer|min:0',
            'precio' => 'required|numeric|min:0',
        ]);

        // Si se ingresa un nuevo tipo de ladrillo
        if ($request->filled('nuevoTipoLadrillo')) {
            $nuevoTipo = TipoLadrillo::create(['tipoLadrillo' => $request->nuevoTipoLadrillo]);
            $request->merge(['idTipoLadrillo' => $nuevoTipo->idTipoLadrillos]);
        }

        // Actualizar el producto
        $producto = Producto::findOrFail($idProducto);
        $producto->update($request->all());

        // Redirigir al listado de productos
        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy($idProducto)
    {
        // Buscar y eliminar el producto
        $producto = Producto::findOrFail($idProducto);
        $producto->delete();

        // Redirigir al listado de productos
        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
    }
}