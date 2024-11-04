@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Agregar Proveedor y Materia Prima</h1>
        <form action="{{ route('materiaprima.store') }}" method="POST">
            @csrf

            <!-- Datos del proveedor -->
            <div class="form-group">
                <label for="nombreProveedor">Nombre del Proveedor</label>
                <input type="text" name="nombreProveedor" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="telefonoProveedor">Teléfono</label>
                <input type="number" name="telefonoProveedor" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="direccionProveedor">Dirección</label>
                <input type="text" name="direccionProveedor" class="form-control" required>
            </div>

            <!-- Datos de la materia prima -->
            <div class="form-group">
                <label for="nombreMateriaPrima">Nombre de la Materia Prima</label>
                <input type="text" name="nombreMateriaPrima" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="cantidadDisponible">Cantidad Disponible</label>
                <input type="number" name="cantidadDisponible" class="form-control" step="0.01" required>
            </div>

            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('materiaprima.index') }}" class="btn btn-secondary">Regresar</a>
        </form>
    </div>
@endsection