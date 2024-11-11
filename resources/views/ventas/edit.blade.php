@extends('layouts.app')

@section('content')
<div class="container">
    <br>
    <h2 class="mb-4">Editar Venta</h2>
    <form action="{{ route('ventas.update', $venta->idVenta) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Datos del Cliente -->
        <div class="card mb-4">
            <div class="card-header">Datos del Cliente</div>
            <div class="card-body">
                <p><strong>Cliente:</strong> {{ $venta->cliente->persona->nombre }} {{ $venta->cliente->persona->apellido }}</p>
                <p><strong>Fecha de Venta:</strong> {{ $venta->fecha }}</p>
            </div>
        </div>

        <!-- Producto -->
        <div class="card mb-4">
            <div class="card-header">Producto</div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-8">
                        <label for="idProducto" class="form-label">Producto:</label>
                        <select name="idProducto" id="producto" class="form-select" required onchange="updatePrecio()">
                            @foreach ($productos as $producto)
                                <option value="{{ $producto->idProducto }}" data-precio="{{ $producto->precio }}" data-tipo="{{ $producto->tipoLadrillo->tipoLadrillo }}"
                                    {{ $venta->idProducto == $producto->idProducto ? 'selected' : '' }}>
                                    {{ $producto->nombreProducto }} - Precio: {{ number_format($producto->precio, 2) }} Bs - Tipo: {{ $producto->tipoLadrillo->tipoLadrillo }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="cantidad" class="form-label">Cantidad:</label>
                        <input type="number" name="cantidad" id="cantidad" value="{{ $venta->total }}" min="1" max="999999" class="form-control" oninput="calcularTotal()" required>
                    </div>
                </div>

                <p><strong>Tipo de Ladrillo:</strong> <span id="tipoLadrillo">{{ $venta->tipoLadrillo }}</span></p>
                <p><strong>Precio Total:</strong> <span id="precioTotal">{{ number_format($venta->precio, 2) }}</span> Bs</p>
            </div>
        </div>

        <div class="d-flex justify-content-start mt-3">
            <button type="submit" class="btn btn-primary me-3">Actualizar Venta</button>
            <a href="{{ route('ventas.index') }}" class="btn btn-secondary">Regresar</a>
        </div>
    </form>
</div>

<script>
    function updatePrecio() {
        const selectedProduct = document.querySelector('#producto');
        const precio = parseFloat(selectedProduct.options[selectedProduct.selectedIndex].getAttribute('data-precio'));
        const tipo = selectedProduct.options[selectedProduct.selectedIndex].getAttribute('data-tipo');

        document.querySelector('#precioTotal').innerText = (precio * document.querySelector('#cantidad').value).toFixed(2);
        document.querySelector('#tipoLadrillo').innerText = tipo;
    }

    function calcularTotal() {
        const selectedProduct = document.querySelector('#producto');
        const precio = parseFloat(selectedProduct.options[selectedProduct.selectedIndex].getAttribute('data-precio'));
        
        document.querySelector('#precioTotal').innerText = (precio * document.querySelector('#cantidad').value).toFixed(2);
    }
    document.querySelector('input[name="cantidad"]').addEventListener('input', function (event) {
            event.target.value = event.target.value.replace(/[^0-9.]/g, '').substring(0, 9);
        });

    // Cálculo inicial del total
    document.addEventListener('DOMContentLoaded', calcularTotal);
</script>
@endsection