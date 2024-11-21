@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <h1>Editar Proveedor y Materia Prima</h1>
        <form action="{{ route('materiaprima.update', $materiaPrima->idMaterial) }}" method="POST">
            @csrf
            @method('PUT')
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
            <div class="form-group">
                <label for="nombreMateriaPrima">Nombre de la Materia Prima</label>
                <input type="text" name="nombreMateriaPrima" class="form-control" value="{{ $materiaPrima->nombreMateriaPrima }}" required>
            </div>
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
            <div class="form-group" id="cantidadModificarContainer" style="display:none;">
                <label for="cantidadModificar">Cantidad a Modificar</label>
                <input type="text" step="0.01" id="cantidadModificar" name="cantidadModificar" class="form-control" placeholder="Ingrese la cantidad a modificar">
            </div>
            <div class="form-group">
                <label>Cantidad Final: <span id="cantidadFinal">{{ $materiaPrima->cantidadDisponible }}</span></label>
            </div>
            <div class="form-group">
                <label for="fechaUltimaCompra">Fecha de Última Compra</label>
                <input type="date" name="fechaUltimaCompra" class="form-control" value="{{ $materiaPrima->fechaUltimaCompra }}" required>
            </div>
            <br>
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
        const errorMessageDiv = document.createElement('div');
        errorMessageDiv.style.color = 'red';
        errorMessageDiv.style.display = 'none';
        errorMessageDiv.textContent = 'La cantidad resultante no puede ser negativa.';
        cantidadModificarContainer.appendChild(errorMessageDiv);
        function updateCantidadFinal() {
            let nuevaCantidad = cantidadInicial;
            if (cantidadAction.value === 'aumentar' && cantidadModificar.value) {
                nuevaCantidad += parseFloat(cantidadModificar.value) || 0;
            } else if (cantidadAction.value === 'reducir' && cantidadModificar.value) {
                nuevaCantidad -= parseFloat(cantidadModificar.value) || 0;
            }
            if (nuevaCantidad < 0) {
                cantidadFinal.innerText = '0.00'; 
                errorMessageDiv.style.display = 'block'; 
            } else {
                cantidadFinal.innerText = nuevaCantidad.toFixed(2); 
                errorMessageDiv.style.display = 'none'; 
            }
        }
        cantidadAction.addEventListener('change', function() {
            if (cantidadAction.value === 'mantener') {
                cantidadModificarContainer.style.display = 'none';
                cantidadFinal.innerText = cantidadInicial.toFixed(2);
                errorMessageDiv.style.display = 'none';
            } else {
                cantidadModificarContainer.style.display = 'block'; 
                cantidadModificar.value = ""; 
                updateCantidadFinal();
            }
        });
        cantidadModificar.addEventListener('input', updateCantidadFinal);
        if (cantidadAction.value !== 'mantener') {
            cantidadModificarContainer.style.display = 'block';
        }
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
        document.querySelector('input[name="cantidadModificar"]').addEventListener('input', function (event) {
            event.target.value = event.target.value.replace(/[^0-9.]/g, '').substring(0, 9);
        });
        const fechaUltimaCompra = document.querySelector('input[name="fechaUltimaCompra"]');
        const today = new Date();
        const tenYearsAgo = new Date();
        tenYearsAgo.setFullYear(today.getFullYear() - 10);
        const formattedToday = today.toISOString().split('T')[0];
        const formattedTenYearsAgo = tenYearsAgo.toISOString().split('T')[0];
        fechaUltimaCompra.setAttribute('max', formattedToday);
        fechaUltimaCompra.setAttribute('min', formattedTenYearsAgo);
        fechaUltimaCompra.addEventListener('change', function (event) {
            const selectedDate = new Date(event.target.value);
            if (selectedDate > today) {
                alert('La fecha de última compra no puede ser futura.');
                event.target.value = formattedToday;
            } else if (selectedDate < tenYearsAgo) {
                alert('La fecha de última compra no puede ser anterior a 10 años.');
                event.target.value = formattedTenYearsAgo;
            }
        });
    });
</script>

@endsection