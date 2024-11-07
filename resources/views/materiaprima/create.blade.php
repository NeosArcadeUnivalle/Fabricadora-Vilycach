@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agregar Proveedor y Materia Prima</h1>
    <form action="{{ route('materiaprima.store') }}" method="POST">
        @csrf

        <!-- Datos del proveedor -->
        <div class="form-group">
            <label for="nombreProveedor">Nombre del Proveedor</label>
            <input type="text" name="nombreProveedor" class="form-control" required pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" maxlength="100" title="Solo letras y hasta 100 caracteres">
        </div>
        <div class="form-group">
            <label for="telefonoProveedor">Teléfono</label>
            <input type="number" name="telefonoProveedor" class="form-control" required minlength="7" maxlength="20">
        </div>
        <div class="form-group">
            <label for="direccionProveedor">Dirección</label>
            <input type="text" name="direccionProveedor" class="form-control" required maxlength="255">
        </div>

        <!-- Datos de la materia prima -->
        <div class="form-group">
            <label for="nombreMateriaPrima">Nombre de la Materia Prima</label>
            <input type="text" name="nombreMateriaPrima" class="form-control" required maxlength="100">
        </div>
        <div class="form-group">
            <label for="cantidadDisponible">Cantidad Disponible</label>
            <input type="number" name="cantidadDisponible" class="form-control" step="0.01" required min="0">
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('materiaprima.index') }}" class="btn btn-secondary">Regresar</a>
    </form>
</div>

<!-- Scripts de validación -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Validar campo "Nombre del Proveedor"
        document.querySelector('input[name="nombreProveedor"]').addEventListener('input', function (event) {
            event.target.value = event.target.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '').substring(0, 100);
        });

        // Validar campo "Teléfono" - solo números
        document.querySelector('input[name="telefonoProveedor"]').addEventListener('input', function (event) {
            event.target.value = event.target.value.replace(/[^0-9]/g, '').substring(0, 20);
        });

        // Validar campo "Nombre de la Materia Prima"
        document.querySelector('input[name="nombreMateriaPrima"]').addEventListener('input', function (event) {
            event.target.value = event.target.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '').substring(0, 100);
        });

        // Validar campo "Cantidad Disponible" - solo números y punto decimal
        document.querySelector('input[name="cantidadDisponible"]').addEventListener('input', function (event) {
            event.target.value = event.target.value.replace(/[^0-9.]/g, '');
        });
    });
</script>
@endsection