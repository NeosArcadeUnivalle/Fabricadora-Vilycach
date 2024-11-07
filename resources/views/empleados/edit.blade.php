@extends('layouts.app')

@section('content')
<div class="container">
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

<!-- Scripts de validación -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Validar campo "Nombre"
        document.querySelector('input[name="nombre"]').addEventListener('input', function (event) {
            event.target.value = event.target.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '').substring(0, 100);
        });

        // Validar campo "Apellido"
        document.querySelector('input[name="apellido"]').addEventListener('input', function (event) {
            event.target.value = event.target.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '').substring(0, 100);
        });

        // Validar campo "Correo Electrónico" (email format - se gestiona en HTML5)
        document.querySelector('input[name="correoElectronico"]').setAttribute('maxlength', '100');

        // Validar campo "Contraseña" (mínimo 8 caracteres, sin caracteres específicos)
        document.querySelector('input[name="password"]').setAttribute('minlength', '8');

        // Validar campo "Puesto" (solo letras y espacios, máximo 50 caracteres)
        document.querySelector('input[name="puesto"]').addEventListener('input', function (event) {
            event.target.value = event.target.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '').substring(0, 50);
        });

        const fechaContratacionInput = document.querySelector('input[name="fechaContratacion"]');
        const today = new Date();
        const formattedToday = today.toISOString().split('T')[0];
        fechaContratacionInput.setAttribute('max', formattedToday);

        fechaContratacionInput.addEventListener('change', function (event) {
            const selectedDate = new Date(event.target.value);
            if (selectedDate > today) {
                alert('La fecha de contratación no puede ser futura. Se ajustará a la fecha de hoy.');
                event.target.value = formattedToday; // Ajustar automáticamente a la fecha de hoy si se selecciona una futura
            }
        });
    });
</script>
@endsection