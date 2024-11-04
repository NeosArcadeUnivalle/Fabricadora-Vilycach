@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Registrar Producción</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('produccion.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" name="fecha" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="cantidadProducida">Cantidad Producida</label>
                <input type="number" name="cantidadProducida" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="idProducto">Producto</label>
                <select name="idProducto" class="form-control">
                    @foreach ($productos as $producto)
                        <option value="{{ $producto->idProducto }}">
                            {{ $producto->nombreProducto }} - {{ $producto->tipoLadrillo->tipoLadrillo }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="idEmpleadoResponsable">Empleado Responsable</label>
                <select name="idEmpleadoResponsable" class="form-control" required>
                    @foreach ($empleados as $empleado)
                        <option value="{{ $empleado->idEmpleado }}">
                            {{ $empleado->persona->nombre }} {{ $empleado->persona->apellido }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('produccion.index') }}" class="btn btn-secondary">Regresar</a>
        </form>
    </div>
@endsection