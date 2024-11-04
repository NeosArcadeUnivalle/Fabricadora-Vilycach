@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Agregar Producto</h1>
        <form action="{{ route('productos.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombreProducto">Nombre del Producto</label>
                <input type="text" name="nombreProducto" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="cantidadDisponible">Cantidad Disponible</label>
                <input type="number" name="cantidadDisponible" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="precio">Precio</label>
                <input type="number" name="precio" class="form-control" required step="0.01">
            </div>
            <div class="form-group">
                <label for="idTipoLadrillo">Tipo de Ladrillo</label>
                <select name="idTipoLadrillo" id="idTipoLadrillo" class="form-control" required>
                    <option value="">Seleccione un tipo de ladrillo</option>
                    @foreach ($tiposLadrillos as $tipo)
                        <option value="{{ $tipo->idTipoLadrillos }}">{{ $tipo->tipoLadrillo }}</option>
                    @endforeach
                    <option value="nuevo">Añadir nuevo tipo de ladrillo</option>
                </select>
            </div>
            <div class="form-group" id="nuevoTipoLadrilloField" style="display: none;">
                <label for="nuevoTipoLadrillo">Nuevo Tipo de Ladrillo</label>
                <input type="text" name="nuevoTipoLadrillo" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('productos.index') }}" class="btn btn-secondary">Regresar</a>
        </form>
    </div>

    <script>
        document.getElementById('idTipoLadrillo').addEventListener('change', function() {
            var nuevoTipoLadrilloField = document.getElementById('nuevoTipoLadrilloField');
            if (this.value === 'nuevo') {
                nuevoTipoLadrilloField.style.display = 'block';
            } else {
                nuevoTipoLadrilloField.style.display = 'none';
            }
        });
    </script>
@endsection