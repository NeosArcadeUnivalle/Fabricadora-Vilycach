@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Proveedor y Materia Prima</h1>
        <form action="{{ route('materiaprima.update', $materiaPrima->idMaterial) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Datos del proveedor -->
            <div class="form-group">
                <label for="nombreProveedor">Nombre del Proveedor</label>
                <input type="text" name="nombreProveedor" class="form-control" value="{{ $materiaPrima->proveedor->nombreProveedor }}" required>
            </div>
            <div class="form-group">
                <label for="telefonoProveedor">Teléfono</label>
                <input type="number" name="telefonoProveedor" class="form-control" value="{{ $materiaPrima->proveedor->telefonoProveedor }}" required>
            </div>
            <div class="form-group">
                <label for="direccionProveedor">Dirección</label>
                <input type="text" name="direccionProveedor" class="form-control" value="{{ $materiaPrima->proveedor->direccionProveedor }}" required>
            </div>

            <!-- Datos de la materia prima -->
            <div class="form-group">
                <label for="nombreMateriaPrima">Nombre de la Materia Prima</label>
                <input type="text" name="nombreMateriaPrima" class="form-control" value="{{ $materiaPrima->nombreMateriaPrima }}" required>
            </div>

            <!-- Cantidad disponible con opciones de acción -->
            <div class="form-group">
                <label for="cantidadDisponible">Cantidad Actual: <span id="cantidadActual">{{ $materiaPrima->cantidadDisponible }}</span></label>
                <input type="hidden" id="cantidadInicial" value="{{ $materiaPrima->cantidadDisponible }}">
            </div>

            <div class="form-group">
                <label for="cantidadAction">Acción sobre la Cantidad</label>
                <select name="cantidadAction" id="cantidadAction" class="form-control">
                    <option value="mantener">Mantener cantidad actual</option>
                    <option value="aumentar">Aumentar cantidad</option>
                    <option value="reducir">Reducir cantidad</option>
                </select>
            </div>

            <!-- Campo oculto para ingresar cantidad a modificar -->
            <div class="form-group" id="cantidadModificarContainer" style="display:none;">
                <label for="cantidadModificar">Cantidad a Modificar</label>
                <input type="number" step="0.01" id="cantidadModificar" name="cantidadModificar" class="form-control" placeholder="Ingrese la cantidad a modificar">
            </div>

            <!-- Mostrar cantidad calculada en tiempo real -->
            <div class="form-group">
                <label>Cantidad Final: <span id="cantidadFinal">{{ $materiaPrima->cantidadDisponible }}</span></label>
            </div>

            <!-- Fecha de última compra -->
            <div class="form-group">
                <label for="fechaUltimaCompra">Fecha de Última Compra</label>
                <input type="date" name="fechaUltimaCompra" class="form-control" value="{{ $materiaPrima->fechaUltimaCompra }}" required>
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="{{ route('materiaprima.index') }}" class="btn btn-secondary">Regresar</a>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cantidadAction = document.getElementById('cantidadAction');
            const cantidadModificarContainer = document.getElementById('cantidadModificarContainer');
            const cantidadModificar = document.getElementById('cantidadModificar');
            const cantidadFinal = document.getElementById('cantidadFinal');
            const cantidadInicial = parseFloat(document.getElementById('cantidadInicial').value);

            function updateCantidadFinal() {
                let nuevaCantidad = cantidadInicial;

                if (cantidadAction.value === 'aumentar' && cantidadModificar.value) {
                    nuevaCantidad += parseFloat(cantidadModificar.value) || 0;
                } else if (cantidadAction.value === 'reducir' && cantidadModificar.value) {
                    nuevaCantidad -= parseFloat(cantidadModificar.value) || 0;
                }

                cantidadFinal.innerText = nuevaCantidad.toFixed(2);
            }

            cantidadAction.addEventListener('change', function() {
                if (cantidadAction.value === 'mantener') {
                    cantidadModificarContainer.style.display = 'none';
                    cantidadFinal.innerText = cantidadInicial.toFixed(2);
                } else {
                    cantidadModificarContainer.style.display = 'block';
                    updateCantidadFinal();
                }
            });

            cantidadModificar.addEventListener('input', updateCantidadFinal);
        });
    </script>
@endsection