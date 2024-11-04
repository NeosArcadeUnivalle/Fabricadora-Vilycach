<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Persona;
use App\Models\LugarDeVenta;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VentaController extends Controller
{
    public function create()
    {
        // Obtener todos los productos con su tipo de ladrillo
        $productos = Producto::with('tipoLadrillo')->get();
        return view('ventas.create', compact('productos'));
    }

    public function store(Request $request)
    {
        // Validamos la entrada
        $request->validate([
            'nombre' => 'required|string|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/|max:100',
            'apellido' => 'required|string|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/|max:100',
            'empresa' => 'nullable|string|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/|max:100',
            'telefono' => 'required|string|max:20',
            'producto' => 'required|integer',
            'cantidad' => 'required|integer|min:1',
            'nombreLugarVenta' => 'required|string|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/|max:100',
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/|max:100',
        ]);

        // Buscar o crear Persona
        $persona = Persona::firstOrCreate([
            'nombre' => $request->input('nombre'),
            'apellido' => $request->input('apellido')
        ]);

        // Buscar o crear Cliente
        $cliente = Cliente::firstOrCreate([
            'idPersona' => $persona->idPersona
        ], [
            'empresa' => $request->input('empresa', 'Ninguna'),  // Si no hay empresa, "Ninguna"
            'telefono' => $request->input('telefono')
        ]);

        // Crear o actualizar el Lugar de Venta
        $lugarVenta = LugarDeVenta::create([
            'nombreLugarVenta' => $request->input('nombreLugarVenta'),
            'direccion' => $request->input('direccion'),
            'ciudad' => $request->input('ciudad')
        ]);

        // Obtener el producto seleccionado y su precio unitario
        $producto = Producto::findOrFail($request->input('producto'));

        // Calcular el precio total (cantidad * precio_unitario)
        $cantidad = $request->input('cantidad');
        $precioUnitario = $producto->precio;
        $precioTotal = $cantidad * $precioUnitario;  // Aquí calculamos el total

        // Registrar la venta
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

        if ($venta) {
            return redirect()->route('ventas.index')->with('success', 'Venta registrada exitosamente.');
        } else {
            return redirect()->back()->with('error', 'Hubo un problema al registrar la venta.');
        }
    }

    public function index(Request $request)
    {
        $query = Venta::with('cliente.persona', 'producto', 'lugarVenta');
    
        // Filtro por estado
        if ($request->has('estado') && $request->estado != '') {
            $query->where('estado', $request->estado);
        }
    
        // Filtro de búsqueda
        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('cliente.persona', function ($q) use ($search) {
                $q->where('nombre', 'like', "%$search%")
                  ->orWhere('apellido', 'like', "%$search%");
            });
        }
    
        // Paginación
        $ventas = $query->paginate(5);
    
        return view('ventas.index', compact('ventas'));
    }
    
    
    public function edit($id)
    {
        // Obtener la venta específica
        $venta = Venta::findOrFail($id);
    
        // Verificar si la venta está completada
        if ($venta->estado === 'Completado') {
            return redirect()->route('ventas.index')->with('error', 'No se puede editar una venta completada.');
        }

        // Obtener los productos disponibles con su relación a tipoLadrillo
        $productos = Producto::with('tipoLadrillo')->get();
    
        return view('ventas.edit', compact('venta', 'productos'));
    }
    
    public function update(Request $request, $id)
    {
        // Buscar la venta
        $venta = Venta::findOrFail($id);

        // No permitir actualizar una venta completada
        if ($venta->estado === 'Completado') {
            return redirect()->route('ventas.index')->with('error', 'No se puede editar una venta completada.');
        }

        // Validar los datos
        $request->validate([
            'idProducto' => 'required|integer|exists:productos,idProducto',
            'cantidad' => 'required|integer|min:1',
        ]);

        // Obtener el producto seleccionado
        $producto = Producto::findOrFail($request->input('idProducto'));

        // Calcular el precio total
        $cantidad = $request->input('cantidad');
        $precioTotal = $producto->precio * $cantidad;

        // Actualizar los datos de la venta
        $venta->idProducto = $producto->idProducto;
        $venta->nombreProducto = $producto->nombreProducto;
        $venta->precio = $precioTotal;  // Precio total calculado
        $venta->total = $cantidad;  // Cantidad
        $venta->tipoLadrillo = $producto->tipoLadrillo->tipoLadrillo;  // Tipo de ladrillo

        // Guardar los cambios
        $venta->save();

        return redirect()->route('ventas.index')->with('success', 'Venta actualizada exitosamente.');
    }
    
    public function updateEstado($id)
    {
        $venta = Venta::findOrFail($id);
        
        // Cambiar estado a 'Completado'
        $venta->estado = 'Completado';
    
        // Realizar la resta de la cantidad del producto en la tabla Producto
        if ($venta->estado == 'Completado') {
            $producto = Producto::findOrFail($venta->idProducto);
            $producto->cantidadDisponible -= $venta->total;  // Restar la cantidad vendida
            $producto->save();
        }
    
        $venta->save();
    
        return redirect()->route('ventas.index')->with('success', 'Venta completada correctamente.');
    }
    

    public function destroy($id)
    {
        // Buscar la venta y eliminarla
        $venta = Venta::findOrFail($id);
        $venta->delete();

        return redirect()->route('ventas.index')->with('success', 'Venta eliminada exitosamente.');
    }
}