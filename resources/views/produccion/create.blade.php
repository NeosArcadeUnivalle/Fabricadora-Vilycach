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
            <input type="date" name="fecha" class="form-control" required max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
        </div>
        <div class="form-group">
            <label for="cantidadProducida">Cantidad Producida</label>
            <input type="number" name="cantidadProducida" class="form-control" required min="1" step="1">
        </div>
        <div class="form-group">
            <label for="idProducto">Producto</label>
            <select name="idProducto" class="form-control" required>
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
@if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif

@if(session('error'))
    <script>
        alert("{{ session('error') }}");
    </script>
@endif

@if($errors->any())
    <script>
        alert("{{ $errors->first() }}");
    </script>
@endif
@endsection