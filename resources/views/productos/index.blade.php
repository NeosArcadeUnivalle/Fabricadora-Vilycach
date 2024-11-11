@extends('layouts.app')

@section('content')
<!-- Estilos estilizados específicos para el navbar en esta vista -->
<style>
    /* Variables de color */
    :root {
        --primary-color: #f4f4f4; /* Fondo claro para resaltar el logo */
        --secondary-color: #b22222; /* Rojo oscuro para los textos */
        --hover-color: #8b0000; /* Color de hover */
        --text-color: #333; /* Color de texto principal */
    }

    /* Contenedor del navbar */
    .navbar-container {
        width: 100%;
        background-color: var(--primary-color);
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }

    /* Navbar */
    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 30px;
        color: var(--text-color);
        font-family: 'Poppins', sans-serif;
        font-weight: bold;
        letter-spacing: 1px;
    }

    /* Logo */
    .navbar-logo {
        display: flex;
        align-items: center;
        text-decoration: none;
    }

    .logo-img {
        height: 50px;
        width: auto;
        border-radius: 5px;
    }

    /* Links del navbar */
    .navbar-links {
        display: flex;
        list-style: none;
        gap: 20px;
        margin: 0;
        padding: 0;
    }

    .navbar-links a {
        color: var(--secondary-color);
        text-decoration: none;
        text-transform: uppercase;
        font-weight: bold;
        padding: 10px 15px;
        border-radius: 5px;
        transition: background-color 0.3s, color 0.3s;
        font-size: 14px;
    }

    .navbar-links a:hover {
        background-color: var(--hover-color);
        color: var(--primary-color);
    }

    /* Botón toggle para dispositivos móviles */
    .navbar-toggle {
        display: none;
        font-size: 24px;
        background: none;
        border: none;
        color: var(--secondary-color);
        cursor: pointer;
    }

    /* Responsividad */
    @media (max-width: 768px) {
        .navbar-links {
            flex-direction: column;
            position: absolute;
            top: 70px;
            right: 0;
            background-color: var(--primary-color);
            width: 100%;
            display: none;
            padding: 10px 0;
            text-align: center;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.15);
        }

        .navbar-links.active {
            display: flex;
        }

        .navbar-toggle {
            display: block;
        }

        .navbar-links li {
            margin-bottom: 10px;
        }
    }
</style>

<!-- Script para el toggle del menú en móvil -->
<script>
    function toggleNavbar() {
        const links = document.querySelector('.navbar-links');
        links.classList.toggle('active');
    }
</script>
<div class="container">
    <br>
        <h1>Lista de Productos</h1>

        <!-- Formulario de búsqueda -->
        <form method="GET" action="{{ route('productos.index') }}" class="form-inline mb-3">
            <input type="text" name="search" class="form-control" placeholder="Buscar producto..." value="{{ request('search') }}" oninput="this.form.submit()">
        </form>

        <!-- Botón para agregar producto -->
        <a href="{{ route('productos.create') }}" class="btn btn-primary mb-3">Agregar Producto</a>

        <!-- Tabla de productos -->
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Cantidad Disponible</th>
                    <th>Precio</th>
                    <th>Tipo de Ladrillo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    <tr>
                        <td>{{ $producto->nombreProducto }}</td>
                        <td>{{ $producto->cantidadDisponible }}</td>
                        <td>{{ $producto->precio }}</td>
                        <td>{{ $producto->tipoLadrillo->tipoLadrillo }}</td>
                        <td>
                            <a href="{{ route('productos.edit', $producto->idProducto) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('productos.destroy', $producto->idProducto) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Seguro que deseas eliminar este producto?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Paginación -->
        <div class="d-flex justify-content-center">
            {{ $productos->links('pagination::bootstrap-4') }}
        </div>
    </div>
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