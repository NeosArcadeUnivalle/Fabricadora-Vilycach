@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agregar Empleado</h1>
    <form action="{{ route('empleados.store') }}" method="POST">
        @csrf
        <!-- Datos de la persona -->
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" class="form-control" required>
        </div>

        <!-- Datos del empleado -->
        <div class="form-group">
            <label for="correoElectronico">Correo Electrónico</label>
            <input type="email" name="correoElectronico" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="puesto">Puesto</label>
            <input type="text" name="puesto" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="fechaContratacion">Fecha de Contratación</label>
            <input type="date" name="fechaContratacion" class="form-control" required>
        </div>
        <div class="d-flex justify-content-start mt-3">
            <button type="submit" class="btn btn-success me-3">Guardar</button>
            <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Regresar</a>
        </div>
    </form>
</div>
@endsection