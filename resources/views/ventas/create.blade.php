@extends('layouts.app')

@section('content')

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #b22222;">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center">
            <img src="{{ asset('img/logo-fotor-2024092416012.png') }}" alt="Logo" style="width: 40px; height: 40px; margin-right: 8px;">
            <span style="color: #ffd700; font-weight: bold; font-size: 1.5em;">Vilycach</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/" style="color: #fff; font-weight: 600; text-transform: uppercase; transition: color 0.3s;">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/ventas/create" style="color: #fff; font-weight: 600; text-transform: uppercase; transition: color 0.3s;">Comprar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/catalogo" style="color: #fff; font-weight: 600; text-transform: uppercase; transition: color 0.3s;">Catálogo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/empleado/login" style="color: #fff; font-weight: 600; text-transform: uppercase; transition: color 0.3s;">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Form Section -->
<div class="container my-5" style="background-color: #f4f6f8; padding: 20px; border-radius: 8px;">
    <h1 class="mb-4 text-center" style="color: #b22222; font-weight: bold;">Comprar</h1>
    <form method="POST" action="{{ route('ventas.store') }}">
        @csrf
        <!-- Datos del Cliente -->
        <div class="card mb-4 shadow-sm border-0" style="background-color: #ffffff;">
            <div class="card-header" style="background-color: #b22222; color: #ffd700; font-weight: bold;">Datos del Cliente</div>
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
        <div class="card mb-4 shadow-sm border-0" style="background-color: #ffffff;">
            <div class="card-header" style="background-color: #b22222; color: #ffd700; font-weight: bold;">Producto</div>
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
        <div class="card mb-4 shadow-sm border-0" style="background-color: #ffffff;">
            <div class="card-header" style="background-color: #b22222; color: #ffd700; font-weight: bold;">Lugar de Venta</div>
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
        <div class="card mb-4 shadow-sm border-0" style="background-color: #ffffff;">
            <div class="card-header" style="background-color: #b22222; color: #ffd700; font-weight: bold;">Total</div>
            <div class="card-body">
                <p class="fs-4 text-center" style="color: #333;">Total: <span id="total" style="color: #b22222; font-weight: bold;">0.00</span> Bs</p>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="d-flex justify-content-center mt-3">
            <button type="submit" class="btn me-3" style="background-color: #b22222; color: #ffd700; font-weight: bold;">Solicitar Compra</button>
            <a href="/" class="btn btn-secondary">Regresar</a>
        </div>
    </form>
</div>

<!-- Footer -->
<footer class="text-center" style="background-color: #333; color: #fff; padding: 40px 0;">
    <div class="container">
        <div class="footer-logo" style="color: #ffd700; font-size: 1.5em; font-weight: bold;">Grupo Industrial Vilycach</div>
        <p>&copy; 2024 Vilycach. Todos los derechos reservados.</p>
        <div class="social-icons">
            <a href="https://www.facebook.com/profile.php?id=100064032765756" style="color: #ffd700; margin: 0 10px; font-size: 1.2em;"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="https://wa.me/+59176546965/?text=MasInformacion" style="color: #ffd700; margin: 0 10px; font-size: 1.2em;"><i class="fa-brands fa-whatsapp"></i></a>
            <a href="https://www.instagram.com/univalle_bolivia/" style="color: #ffd700; margin: 0 10px; font-size: 1.2em;"><i class="fa-brands fa-instagram"></i></a>
        </div>
    </div>
</footer>

<!-- Scroll-to-top Button -->
<a href="#" class="scroll-to-top" style="display: none; position: fixed; bottom: 25px; right: 25px; color: #ffd700; font-size: 1.5em; z-index: 1000;">
    <i class="fas fa-chevron-up"></i>
</a>

<!-- Scripts -->
<script>
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('mouseenter', () => {
            link.style.color = '#ffd700';
        });
        link.addEventListener('mouseleave', () => {
            link.style.color = link.innerText === 'Comprar' ? '#ffd700' : '#fff';
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const scrollBtn = document.querySelector('.scroll-to-top');
        window.addEventListener('scroll', function () {
            scrollBtn.style.display = window.scrollY > 100 ? 'block' : 'none';
        });
        scrollBtn.addEventListener('click', function (e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    });

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
    function validateLength(element, maxLength) {
        if (element.value.length > maxLength) {
            element.value = element.value.slice(0, maxLength);
        }
    }
    document.addEventListener('DOMContentLoaded', updateTotal);
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