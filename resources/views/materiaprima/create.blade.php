@extends('layouts.app')

@section('content')
<div class="container">
    <br>
    <h1>Agregar Proveedor y Materia Prima</h1>
    <form action="{{ route('materiaprima.store') }}" method="POST">
        @csrf
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
        <div class="form-group">
            <label for="nombreMateriaPrima">Nombre de la Materia Prima</label>
            <input type="text" name="nombreMateriaPrima" class="form-control" required maxlength="100">
        </div>
        <div class="form-group">
            <label for="cantidadDisponible">Cantidad Disponible</label>
            <input type="text" name="cantidadDisponible" class="form-control" step="0.01" required min="0">
        </div>
        <br>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('materiaprima.index') }}" class="btn btn-secondary">Regresar</a>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelector('input[name="nombreProveedor"]').addEventListener('input', function (event) {
            event.target.value = event.target.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '').substring(0, 35);
        });
        
        document.querySelector('input[name="telefonoProveedor"]').addEventListener('input', function (event) {
            event.target.value = event.target.value.replace(/[^0-9]/g, '').substring(0, 8);
        });

        document.querySelector('input[name="direccionProveedor"]').addEventListener('input', function (event) {
            event.target.value = event.target.value.substring(0, 35); // Limita a 35 caracteres
        });

        document.querySelector('input[name="nombreMateriaPrima"]').addEventListener('input', function (event) {
            event.target.value = event.target.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '').substring(0, 35);
        });
        
        document.querySelector('input[name="cantidadDisponible"]').addEventListener('input', function (event) {
            event.target.value = event.target.value.replace(/[^0-9.]/g, '').substring(0, 9);
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