@extends('layouts.app')

@section('content')
<div class="container">
    <br>
    <h1>Editar Empleado</h1>
    <form action="{{ route('empleados.update', $empleado->idEmpleado) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Datos de la persona -->
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ $empleado->persona->nombre }}" required pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" title="Solo letras y hasta 100 caracteres" maxlength="100">
        </div>

        <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" class="form-control" value="{{ $empleado->persona->apellido }}" required pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" title="Solo letras y hasta 100 caracteres" maxlength="100">
        </div>

        <!-- Datos del empleado -->
        <div class="form-group">
            <label for="correoElectronico">Correo Electrónico</label>
            <input type="email" name="correoElectronico" class="form-control" value="{{ $empleado->correoElectronico }}" required maxlength="100">
        </div>

        <div class="form-group">
            <label for="password">Contraseña (opcional)</label>
            <input type="password" name="password" class="form-control" minlength="8">
            <small class="form-text text-muted">Déjalo en blanco si no quieres cambiar la contraseña.</small>
        </div>

        <div class="form-group">
            <label for="puesto">Puesto</label>
            <input type="text" name="puesto" class="form-control" value="{{ $empleado->puesto }}" required maxlength="50">
        </div>

        <div class="form-group">
            <label for="fechaContratacion">Fecha de Contratación</label>
            <input type="date" name="fechaContratacion" class="form-control" value="{{ $empleado->fechaContratacion }}" required max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
        </div>

        <div class="d-flex justify-content-start mt-3">
            <button type="submit" class="btn btn-success me-3">Actualizar</button>
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
        
        // Fecha máxima es hoy
        fechaContratacionInput.setAttribute('max', formattedToday);

        // Fecha mínima es 50 años atrás
        const fiftyYearsAgo = new Date();
        fiftyYearsAgo.setFullYear(today.getFullYear() - 50);
        const formattedFiftyYearsAgo = fiftyYearsAgo.toISOString().split('T')[0];
        fechaContratacionInput.setAttribute('min', formattedFiftyYearsAgo);

        // Validación adicional en el evento 'input'
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
@endsection