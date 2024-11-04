@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Compra y Venta</h1>
    <form method="POST" action="{{ route('ventas.store') }}">
        @csrf

        <!-- Datos del Cliente -->
        <div class="card mb-4">
            <div class="card-header">Datos del Cliente</div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombres:</label>
                        <input type="text" name="nombre" value="{{ old('nombre') }}" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="apellido" class="form-label">Apellidos:</label>
                        <input type="text" name="apellido" value="{{ old('apellido') }}" class="form-control" required>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="tieneEmpresa" class="form-label">¿Tiene Empresa?</label>
                        <select id="tieneEmpresa" class="form-select" onchange="toggleEmpresaInput()">
                            <option value="no">No</option>
                            <option value="si">Sí</option>
                        </select>
                    </div>
                    <div class="col-md-6" id="empresaField" style="display:none;">
                        <label for="empresa" class="form-label">Empresa:</label>
                        <input type="text" name="empresa" value="{{ old('empresa') }}" class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="telefono" class="form-label">Teléfono:</label>
                        <input type="number" name="telefono" value="{{ old('telefono') }}" class="form-control" required>
                    </div>
                </div>
            </div>
        </div>

        <!-- Producto -->
        <div class="card mb-4">
            <div class="card-header">Producto</div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-8">
                        <label for="producto" class="form-label">Producto:</label>
                        <select name="producto" id="producto" class="form-select" required onchange="updateTotal()">
                            @foreach($productos as $producto)
                                <option value="{{ $producto->idProducto }}" data-precio="{{ $producto->precio }}" data-tipo="{{ $producto->tipoLadrillo->tipoLadrillo }}">
                                    {{ $producto->nombreProducto }} ({{ number_format($producto->precio, 2) }} Bs) - Tipo: {{ $producto->tipoLadrillo->tipoLadrillo }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="cantidad" class="form-label">Cantidad:</label>
                        <input type="number" name="cantidad" id="cantidad" value="1" min="1" class="form-control" onchange="updateTotal()" required>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lugar de Venta -->
        <div class="card mb-4">
            <div class="card-header">Lugar de Venta</div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="nombreLugarVenta" class="form-label">Lugar de Venta:</label>
                        <input type="text" name="nombreLugarVenta" value="{{ old('nombreLugarVenta') }}" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label for="direccion" class="form-label">Dirección:</label>
                        <input type="text" name="direccion" value="{{ old('direccion') }}" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label for="ciudad" class="form-label">Ciudad:</label>
                        <input type="text" name="ciudad" value="{{ old('ciudad') }}" class="form-control" required>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total -->
        <div class="card mb-4">
            <div class="card-header">Total</div>
            <div class="card-body">
                <p class="fs-4">Total: <span id="total">0.00</span> Bs</p>
            </div>
        </div>

        <div class="d-flex justify-content-start mt-3">
            <button type="submit" class="btn btn-primary me-3">Registrar Venta</button>
            <a href="/" class="btn btn-secondary">Regresar</a>
        </div>
    </form>
</div>

<!-- Si hay errores de validación, mostrar una ventana emergente -->
@if($errors->any())
    <script>
        let errorMessage = '';
        @foreach ($errors->all() as $error)
            errorMessage += '{{ $error }}\n';
        @endforeach
        alert(errorMessage);
    </script>
@endif

<script>
    // Mostrar u ocultar el campo de empresa
    function toggleEmpresaInput() {
        const empresaField = document.getElementById('empresaField');
        const tieneEmpresa = document.getElementById('tieneEmpresa').value;
        if (tieneEmpresa === 'si') {
            empresaField.style.display = 'block';
        } else {
            empresaField.style.display = 'none';
            document.querySelector('input[name="empresa"]').value = '';
        }
    }

    function updateTotal() {
        const productoSelect = document.getElementById('producto');
        const cantidadInput = document.getElementById('cantidad');
        
        const selectedOption = productoSelect.options[productoSelect.selectedIndex];
        const precio = parseFloat(selectedOption.getAttribute('data-precio'));
        const cantidad = parseInt(cantidadInput.value) || 1;

        const total = precio * cantidad;
        document.getElementById('total').innerText = total.toFixed(2);
    }

    // Actualizar total en el inicio
    document.addEventListener('DOMContentLoaded', updateTotal);
</script>
@endsection