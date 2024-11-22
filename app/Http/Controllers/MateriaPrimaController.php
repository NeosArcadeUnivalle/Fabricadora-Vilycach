<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use App\Models\MateriaPrima;

class MateriaPrimaController extends Controller
{
    public function index(Request $request)
    {
        $query = MateriaPrima::with('proveedor');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('proveedor', function ($q) use ($search) {
                $q->where('nombreProveedor', 'like', "%$search%")
                  ->orWhere('direccionProveedor', 'like', "%$search%");
            })->orWhere('nombreMateriaPrima', 'like', "%$search%");
        }

        $materiasPrimas = $query->paginate(5);

        return view('materiaprima.index', compact('materiasPrimas'));
    }

    public function create()
    {
        return view('materiaprima.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombreProveedor' => 'required|string|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/|max:100',
            'telefonoProveedor' => 'required|numeric|digits:8',
            'direccionProveedor' => 'required|string|max:255',
            'nombreMateriaPrima' => 'required|string|max:100',
            'cantidadDisponible' => 'required|numeric|min:0',
        ]);

        $proveedor = Proveedor::create([
            'nombreProveedor' => $request->nombreProveedor,
            'telefonoProveedor' => $request->telefonoProveedor,
            'direccionProveedor' => $request->direccionProveedor,
        ]);

        MateriaPrima::create([
            'nombreMateriaPrima' => $request->nombreMateriaPrima,
            'cantidadDisponible' => $request->cantidadDisponible,
            'fechaUltimaCompra' => now(),
            'idProveedor' => $proveedor->idProveedor,
        ]);

        return redirect()->route('materiaprima.index')->with('success', 'Materia Prima y Proveedor registrados correctamente.');
    }

    public function edit($id)
    {
        $materiaPrima = MateriaPrima::with('proveedor')->findOrFail($id);
        return view('materiaprima.edit', compact('materiaPrima'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombreProveedor' => 'required|string|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/|max:100',
            'telefonoProveedor' => 'required|numeric|digits_between:7,8',
            'direccionProveedor' => 'required|string|max:255',
            'nombreMateriaPrima' => 'required|string|max:100',
            'cantidadAction' => 'nullable|string',
            'cantidadModificar' => 'nullable|numeric|min:0',
            'fechaUltimaCompra' => 'required|date|before_or_equal:today',
        ]);

        $materiaPrima = MateriaPrima::findOrFail($id);
        $proveedor = Proveedor::findOrFail($materiaPrima->idProveedor);

        $proveedor->update([
            'nombreProveedor' => $request->nombreProveedor,
            'telefonoProveedor' => $request->telefonoProveedor,
            'direccionProveedor' => $request->direccionProveedor,
        ]);

        $cantidadTotal = $materiaPrima->cantidadDisponible;

        if ($request->cantidadAction == 'aumentar' && $request->cantidadModificar > 0) {
            $cantidadTotal += $request->cantidadModificar;
        } elseif ($request->cantidadAction == 'reducir' && $request->cantidadModificar > 0) {
            $cantidadTotal -= $request->cantidadModificar;
        }

        if ($cantidadTotal < 0) {
            return redirect()->back()->withErrors(['error' => 'La cantidad no puede ser negativa.']);
        }

        $materiaPrima->update([
            'nombreMateriaPrima' => $request->nombreMateriaPrima,
            'cantidadDisponible' => $cantidadTotal,
            'fechaUltimaCompra' => $request->fechaUltimaCompra,
        ]);

        return redirect()->route('materiaprima.index')->with('success', 'Materia Prima y Proveedor actualizados correctamente.');
    }

    public function destroy($id)
    {
        $materiaPrima = MateriaPrima::findOrFail($id);
        $proveedor = Proveedor::findOrFail($materiaPrima->idProveedor);

        $materiaPrima->delete();
        $proveedor->delete();

        return redirect()->route('materiaprima.index')->with('success', 'Proveedor y Materia Prima eliminados correctamente.');
    }
}