@extends('layouts.app')

@section('content')
<div class="container">
    <br>
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
            <input type="text" name="cantidadProducida" class="form-control" required min="1" step="1">
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
        <br>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('produccion.index') }}" class="btn btn-secondary">Regresar</a>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fechaInput = document.querySelector('input[name="fecha"]');
        const today = new Date();
        const oneYearAgo = new Date();
        oneYearAgo.setFullYear(today.getFullYear() - 1);
        const formattedToday = today.toISOString().split('T')[0];
        const formattedOneYearAgo = oneYearAgo.toISOString().split('T')[0];
        fechaInput.setAttribute('max', formattedToday);
        fechaInput.setAttribute('min', formattedOneYearAgo);
        fechaInput.addEventListener('change', function (event) {
            const selectedDate = new Date(event.target.value);
            if (selectedDate > today) {
                alert('La fecha de producción no puede ser futura.');
                event.target.value = formattedToday;
            } else if (selectedDate < oneYearAgo) {
                alert('La fecha de producción no puede ser anterior a un año desde hoy.');
                event.target.value = formattedOneYearAgo;
            }
        });
        document.querySelector('input[name="cantidadProducida"]').addEventListener('input', function (event) {
            event.target.value = event.target.value.replace(/[^0-9.]/g, '').substring(0, 9);
            const parts = event.target.value.split('.');
            if (parts.length > 2) {
                event.target.value = parts[0] + '.' + parts[1];
            }
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