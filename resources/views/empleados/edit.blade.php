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
            <input type="text" name="nombre" class="form-control" value="{{ $empleado->persona->nombre }}" required>
        </div>

        <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" class="form-control" value="{{ $empleado->persona->apellido }}" required>
        </div>

        <!-- Datos del empleado -->
        <div class="form-group">
            <label for="correoElectronico">Correo Electrónico</label>
            <input type="email" name="correoElectronico" class="form-control" value="{{ $empleado->correoElectronico }}" required>
        </div>

        <div class="form-group">
            <label for="password">Contraseña (opcional)</label>
            <input type="password" name="password" class="form-control">
            <small class="form-text text-muted">Déjalo en blanco si no quieres cambiar la contraseña.</small>
        </div>

        <div class="form-group">
            <label for="puesto">Puesto</label>
            <input type="text" name="puesto" class="form-control" value="{{ $empleado->puesto }}" required>
        </div>

        <div class="form-group">
            <label for="fechaContratacion">Fecha de Contratación</label>
            <input type="date" name="fechaContratacion" class="form-control" value="{{ $empleado->fechaContratacion }}" required>
        </div>

        <div class="d-flex justify-content-start mt-3">
            <button type="submit" class="btn btn-success me-3">Actualizar</button>
            <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Regresar</a>
        </div>

    </form>
</div>
@endsection