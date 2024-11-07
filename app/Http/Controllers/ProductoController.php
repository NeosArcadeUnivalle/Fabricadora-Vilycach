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
        $tiposLadrillos = TipoLadrillo::all();
        return view('productos.create', compact('tiposLadrillos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombreProducto' => 'required|string|max:100|regex:/^[a-zA-Z0-9\s]+$/',
            'cantidadDisponible' => 'required|integer|min:0',
            'precio' => 'required|numeric|min:0',
        ]);

        if ($request->filled('nuevoTipoLadrillo')) {
            $nuevoTipo = TipoLadrillo::create(['tipoLadrillo' => $request->nuevoTipoLadrillo]);
            $request->merge(['idTipoLadrillo' => $nuevoTipo->idTipoLadrillos]);
        }

        Producto::create($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }

    public function edit($idProducto)
    {
        $producto = Producto::findOrFail($idProducto);
        $tiposLadrillos = TipoLadrillo::all();

        return view('productos.edit', compact('producto', 'tiposLadrillos'));
    }

    public function update(Request $request, $idProducto)
    {
        $request->validate([
            'nombreProducto' => 'required|string|max:100|regex:/^[a-zA-Z0-9\s]+$/',
            'cantidadDisponible' => 'required|integer|min:0',
            'precio' => 'required|numeric|min:0',
        ]);

        if ($request->filled('nuevoTipoLadrillo')) {
            $nuevoTipo = TipoLadrillo::create(['tipoLadrillo' => $request->nuevoTipoLadrillo]);
            $request->merge(['idTipoLadrillo' => $nuevoTipo->idTipoLadrillos]);
        }

        $producto = Producto::findOrFail($idProducto);
        $producto->update($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy($idProducto)
    {
        $producto = Producto::findOrFail($idProducto);
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
    }
}