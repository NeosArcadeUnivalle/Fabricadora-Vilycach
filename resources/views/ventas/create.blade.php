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
                        <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" class="form-control" required maxlength="100" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" title="Solo letras y hasta 100 caracteres">
                    </div>
                    <div class="col-md-6">
                        <label for="apellido" class="form-label">Apellidos:</label>
                        <input type="text" name="apellido" id="apellido" value="{{ old('apellido') }}" class="form-control" required maxlength="100" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" title="Solo letras y hasta 100 caracteres">
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
                        <input type="text" name="empresa" id="empresa" value="{{ old('empresa') }}" class="form-control" maxlength="100" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" title="Solo letras y hasta 100 caracteres">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="telefono" class="form-label">Teléfono:</label>
                        <input type="number" name="telefono" id="telefono" value="{{ old('telefono') }}" class="form-control" maxlength="8" pattern="\d{8}" title="Debe ser un número de 8 dígitos" required oninput="validateLength(this, 8)">
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
                        <input type="number" name="cantidad" id="cantidad" value="1" min="1" max="999999" class="form-control" oninput="updateTotal(); validateLength(this, 6)" required>
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
                        <input type="text" name="nombreLugarVenta" id="nombreLugarVenta" value="{{ old('nombreLugarVenta') }}" class="form-control" maxlength="100" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" title="Solo letras y hasta 100 caracteres" required>
                    </div>
                    <div class="col-md-4">
                        <label for="direccion" class="form-label">Dirección:</label>
                        <input type="text" name="direccion" value="{{ old('direccion') }}" class="form-control" maxlength="255" required>
                    </div>
                    <div class="col-md-4">
                        <label for="ciudad" class="form-label">Ciudad:</label>
                        <input type="text" name="ciudad" id="ciudad" value="{{ old('ciudad') }}" class="form-control" maxlength="100" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" title="Solo letras y hasta 100 caracteres" required>
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
        empresaField.style.display = tieneEmpresa === 'si' ? 'block' : 'none';
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

    // Validaciones en tiempo real para nombres, apellidos, empresa, lugar de venta y ciudad
    document.getElementById('nombre').addEventListener('input', (event) => {
        event.target.value = event.target.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '').substring(0, 100);
    });

    document.getElementById('apellido').addEventListener('input', (event) => {
        event.target.value = event.target.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '').substring(0, 100);
    });

    document.getElementById('empresa').addEventListener('input', (event) => {
        event.target.value = event.target.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '').substring(0, 100);
    });

    document.getElementById('nombreLugarVenta').addEventListener('input', (event) => {
        event.target.value = event.target.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '').substring(0, 100);
    });

    document.getElementById('ciudad').addEventListener('input', (event) => {
        event.target.value = event.target.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '').substring(0, 100);
    });

    // Validación de longitud exacta para campos numéricos
    function validateLength(element, maxLength) {
        if (element.value.length > maxLength) {
            element.value = element.value.slice(0, maxLength);
        }
    }

    document.addEventListener('DOMContentLoaded', updateTotal);
</script>
@endsection