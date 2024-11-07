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
            <input type="date" name="fecha" class="form-control" id="fecha" value="{{ $produccion->fecha }}" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
        </div>

        <div class="mb-3">
            <label for="cantidadProducida" class="form-label">Cantidad Producida</label>
            <input type="number" name="cantidadProducida" class="form-control" id="cantidadProducida" value="{{ $produccion->cantidadProducida }}" required min="1" step="1">
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

<!-- Scripts de validación -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fechaInput = document.querySelector('input[name="fecha"]');
        const today = new Date().toISOString().split('T')[0];
        fechaInput.setAttribute('max', today);

        fechaInput.addEventListener('change', function (event) {
            const selectedDate = new Date(event.target.value);
            if (selectedDate > new Date(today)) {
                alert('La fecha de producción no puede ser futura.');
                event.target.value = today;
            }
        });

        document.querySelector('input[name="cantidadProducida"]').addEventListener('input', function (event) {
            event.target.value = event.target.value.replace(/[^0-9]/g, '');
        });
    });
</script>
@endsection