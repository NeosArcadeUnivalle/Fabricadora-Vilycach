@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Producción</h2>
    
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('produccion.update', $produccion->idProduccion) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha de Producción</label>
            <input type="date" name="fecha" class="form-control" id="fecha" value="{{ $produccion->fecha }}">
        </div>

        <div class="mb-3">
            <label for="cantidadProducida" class="form-label">Cantidad Producida</label>
            <input type="number" name="cantidadProducida" class="form-control" id="cantidadProducida" value="{{ $produccion->cantidadProducida }}">
        </div>

        <div class="mb-3">
            <label for="idEmpleadoResponsable" class="form-label">Empleado Responsable</label>
            <select name="idEmpleadoResponsable" class="form-control" id="idEmpleadoResponsable">
                @foreach($empleados as $empleado)
                    <option value="{{ $empleado->idEmpleado }}" {{ $empleado->idEmpleado == $produccion->idEmpleadoResponsable ? 'selected' : '' }}>
                        {{ $empleado->persona->nombre }} {{ $empleado->persona->apellido }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="producto" class="form-label">Producto</label>
            <p class="form-control">{{ $produccion->producto->nombreProducto }} - {{ $produccion->producto->tipoLadrillo->tipoLadrillo }}</p>
            <input type="hidden" name="idProducto" value="{{ $produccion->idProducto }}">
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <a href="{{ route('produccion.index') }}" class="btn btn-secondary">Regresar</a>
    </form>
</div>
@endsection