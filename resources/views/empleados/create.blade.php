@extends('layouts.app')

@section('content')
<div class="container">
    <br>
    <h1>Agregar Empleado</h1>
    <form action="{{ route('empleados.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control" required pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" title="Solo letras y hasta 100 caracteres" maxlength="100">
        </div>
        <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" class="form-control" required pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" title="Solo letras y hasta 100 caracteres" maxlength="100">
        </div>
        <div class="form-group">
            <label for="correoElectronico">Correo Electrónico</label>
            <input type="email" name="correoElectronico" class="form-control" required maxlength="100">
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" name="password" class="form-control" required minlength="8">
        </div>
        <div class="form-group">
            <label for="puesto">Puesto</label>
            <input type="text" name="puesto" class="form-control" required maxlength="50">
        </div>
        <div class="form-group">
            <label for="fechaContratacion">Fecha de Contratación</label>
            <input type="date" name="fechaContratacion" class="form-control" required max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
        </div>
        <div class="d-flex justify-content-start mt-3">
            <button type="submit" class="btn btn-success me-3">Guardar</button>
            <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Regresar</a>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelector('input[name="nombre"]').addEventListener('input', function (event) {
            event.target.value = event.target.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '').substring(0, 35);
        });
        document.querySelector('input[name="apellido"]').addEventListener('input', function (event) {
            event.target.value = event.target.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '').substring(0, 35);
        });
        document.querySelector('input[name="correoElectronico"]').setAttribute('maxlength', '35');
        document.querySelector('input[name="password"]').setAttribute('minlength', '8');
        document.querySelector('input[name="puesto"]').addEventListener('input', function (event) {
            event.target.value = event.target.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '').substring(0, 35);
        });
        const fechaContratacionInput = document.querySelector('input[name="fechaContratacion"]');
        const today = new Date();
        const formattedToday = today.toISOString().split('T')[0];
        fechaContratacionInput.setAttribute('max', formattedToday);
        const fiftyYearsAgo = new Date();
        fiftyYearsAgo.setFullYear(today.getFullYear() - 50);
        const formattedFiftyYearsAgo = fiftyYearsAgo.toISOString().split('T')[0];
        fechaContratacionInput.setAttribute('min', formattedFiftyYearsAgo);
        fechaContratacionInput.addEventListener('input', function (event) {
            const selectedDate = new Date(event.target.value);
            if (selectedDate > today) {
                alert('La fecha de contratación no puede ser futura. Se ajustará a la fecha de hoy.');
                event.target.value = formattedToday;
            } else if (selectedDate < fiftyYearsAgo) {
                alert('La fecha de contratación no puede ser anterior a 50 años. Se ajustará a la fecha mínima permitida.');
                event.target.value = formattedFiftyYearsAgo;
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