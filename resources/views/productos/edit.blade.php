@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Producto</h1>
    <form action="{{ route('productos.update', $producto->idProducto) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombreProducto">Nombre del Producto</label>
            <input type="text" name="nombreProducto" class="form-control" value="{{ $producto->nombreProducto }}" required pattern="[a-zA-Z0-9\s]+" maxlength="100" title="Solo letras, números y espacios">
        </div>
        <div class="form-group">
            <label for="cantidadDisponible">Cantidad Disponible</label>
            <input type="number" name="cantidadDisponible" class="form-control" value="{{ $producto->cantidadDisponible }}" required min="0">
        </div>
        <div class="form-group">
            <label for="precio">Precio</label>
            <input type="number" name="precio" class="form-control" value="{{ $producto->precio }}" required step="0.01" min="0">
        </div>
        <div class="form-group">
            <label for="idTipoLadrillo">Tipo de Ladrillo</label>
            <select name="idTipoLadrillo" id="idTipoLadrillo" class="form-control" required>
                @foreach ($tiposLadrillos as $tipo)
                    <option value="{{ $tipo->idTipoLadrillos }}" {{ $producto->idTipoLadrillo == $tipo->idTipoLadrillos ? 'selected' : '' }}>
                        {{ $tipo->tipoLadrillo }}
                    </option>
                @endforeach
                <option value="nuevo">Añadir nuevo tipo de ladrillo</option>
            </select>
        </div>
        <div class="form-group" id="nuevoTipoLadrilloField" style="display: none;">
            <label for="nuevoTipoLadrillo">Nuevo Tipo de Ladrillo</label>
            <input type="text" name="nuevoTipoLadrillo" class="form-control" pattern="[a-zA-Z0-9\s]+" title="Solo letras, números y espacios">
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Regresar</a>
    </form>
</div>

<script>
    document.getElementById('idTipoLadrillo').addEventListener('change', function() {
        const nuevoTipoLadrilloField = document.getElementById('nuevoTipoLadrilloField');
        nuevoTipoLadrilloField.style.display = this.value === 'nuevo' ? 'block' : 'none';
    });

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelector('input[name="nombreProducto"]').addEventListener('input', function (event) {
            event.target.value = event.target.value.replace(/[^a-zA-Z0-9\s]/g, '').substring(0, 100);
        });

        document.querySelector('input[name="cantidadDisponible"]').addEventListener('input', function (event) {
            event.target.value = event.target.value.replace(/[^0-9]/g, '');
        });

        document.querySelector('input[name="precio"]').addEventListener('input', function (event) {
            event.target.value = event.target.value.replace(/[^0-9.]/g, '');
        });

        document.querySelector('input[name="nuevoTipoLadrillo"]').addEventListener('input', function (event) {
            event.target.value = event.target.value.replace(/[^a-zA-Z0-9\s]/g, '').substring(0, 100);
        });
    });
</script>
@endsection