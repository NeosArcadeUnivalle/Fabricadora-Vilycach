<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Persona;
use Carbon\Carbon;

class EmpleadoController extends Controller
{
    public function index(Request $request)
    {
        $query = Empleado::with('persona');

        // Filtro de búsqueda
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('persona', function ($q) use ($search) {
                $q->where('nombre', 'like', "%$search%")
                  ->orWhere('apellido', 'like', "%$search%");
            });
        }

        // Paginación a 7 filas por página
        $empleados = $query->paginate(7);

        return view('empleados.index', compact('empleados'));
    }

    public function create()
    {
        return view('empleados.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/|max:100',
            'apellido' => 'required|string|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/|max:100',
            'correoElectronico' => 'required|email|unique:empleados|max:100',
            'password' => 'required|string|min:8',
            'puesto' => 'required|string|max:50',
            'fechaContratacion' => 'required|date|before_or_equal:today'
        ]);

        // Crear Persona
        $persona = Persona::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
        ]);

        // Crear Empleado y asignar el id de la persona
        Empleado::create([
            'correoElectronico' => $request->correoElectronico,
            'password' => bcrypt($request->password), // Encriptar contraseña
            'puesto' => $request->puesto,
            'fechaContratacion' => $request->fechaContratacion,
            'idPersona' => $persona->idPersona,
        ]);

        return redirect()->route('empleados.index')->with('success', 'Empleado creado correctamente.');
    }

    public function edit($id)
    {
        $empleado = Empleado::with('persona')->findOrFail($id); // Obtener empleado con datos de persona
        return view('empleados.edit', compact('empleado'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/|max:100',
            'apellido' => 'required|string|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/|max:100',
            'correoElectronico' => 'required|string|email|max:100|unique:empleados,correoElectronico,' . $id . ',idEmpleado',
            'password' => 'nullable|string|min:8',
            'puesto' => 'required|string|max:50',
            'fechaContratacion' => 'required|date|before_or_equal:today',
        ]);
    
        $empleado = Empleado::findOrFail($id);
        $persona = Persona::findOrFail($empleado->idPersona);
    
        $persona->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
        ]);
    
        $data = [
            'correoElectronico' => $request->correoElectronico,
            'puesto' => $request->puesto,
            'fechaContratacion' => $request->fechaContratacion,
        ];
    
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }
    
        $empleado->update($data);
    
        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado correctamente.');
    }
    

    public function destroy($id)
    {
        $empleado = Empleado::findOrFail($id);
        $persona = Persona::findOrFail($empleado->idPersona);

        $empleado->delete();
        $persona->delete();

        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado correctamente.');
    }
}