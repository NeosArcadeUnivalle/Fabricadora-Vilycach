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
    <h1>Lista de Ventas</h1>

    <!-- Filtro de búsqueda -->
    <div class="mb-3">
        <form method="GET" action="{{ route('ventas.index') }}">
            <input type="text" name="search" placeholder="Buscar ventas..." value="{{ request('search') }}" class="form-control" oninput="this.form.submit()">
        </form>
    </div>

    <!-- Filtro por estado de ventas -->
    <div class="mb-3">
        <form method="GET" action="{{ route('ventas.index') }}">
            <label for="estado">Filtrar por estado:</label>
            <select name="estado" id="estado" onchange="this.form.submit()">
                <option value="">Todas</option>
                <option value="En espera" {{ request('estado') == 'En espera' ? 'selected' : '' }}>En espera</option>
                <option value="Completado" {{ request('estado') == 'Completado' ? 'selected' : '' }}>Completado</option>
            </select>
        </form>
    </div>

    <div class="mb-3">
        <a href="{{ route('ventas.create') }}" class="btn btn-primary">Crear Nueva Venta</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID Venta</th>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Producto</th>
                <th>Tipo de Ladrillo</th>
                <th>Cantidad</th>
                <th>Precio Total</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ventas as $venta)
                <tr>
                    <td>{{ $venta->idVenta }}</td>
                    <td>{{ $venta->fecha }}</td>
                    <td>{{ $venta->cliente->persona->nombre }} {{ $venta->cliente->persona->apellido }}</td>
                    <td>{{ $venta->nombreProducto }}</td>
                    <td>{{ $venta->tipoLadrillo }}</td>
                    <td>{{ $venta->total }}</td>
                    <td>{{ $venta->precio }}</td>
                    <td>{{ $venta->estado }}</td>
                    <td>
                        @if ($venta->estado === 'En espera')
                            <a href="{{ route('ventas.edit', $venta->idVenta) }}" class="btn btn-primary">Editar</a>
                            <form action="{{ route('ventas.updateEstado', $venta->idVenta) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas completar esta venta?');">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success">Completar Venta</button>
                            </form>
                        @endif
                        <form action="{{ route('ventas.destroy', $venta->idVenta) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta venta?');">
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
    <div class="d-flex justify-content-center mt-4">
        {{ $ventas->links('pagination::bootstrap-4') }}
    </div>      
</div>

@if($errors->any())
    <script>
        alert("{{ $errors->first() }}");
    </script>
@endif
@endsection