@extends('layouts.app')

@php
    $notificacionesNoVistas = collect($notificaciones)->where('visto', false)->count();
@endphp

@section('content')
<style>
    :root {
        --primary-color: #f4f4f4; 
        --secondary-color: #b22222; 
        --hover-color: #8b0000; 
        --text-color: #333; 
    }

    .navbar-container {
        width: 100%;
        background-color: var(--primary-color);
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }

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

    .navbar-toggle {
        display: none;
        font-size: 24px;
        background: none;
        border: none;
        color: var(--secondary-color);
        cursor: pointer;
    }

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
    .notification-icon {
        position: absolute;
        top: 100px; 
        right: 30px;
        font-size: 1.8em; 
    }
    .notification-icon .badge {
        position: absolute;
        top: -10px;
        right: -10px;
        background-color: red;
        color: white;
        border-radius: 50%;
        padding: 5px 10px;
        font-size: 0.8em;
    }
</style>

<script>
    function toggleNavbar() {
        const links = document.querySelector('.navbar-links');
        links.classList.toggle('active');
    }
</script>
<div class="container">
    <a href="{{ route('notificaciones.index') }}" class="notification-icon">
        <i class="fa fa-bell"></i>
        <span class="badge">{{ $notificacionesNoVistas }}</span>
    </a>
    <br>
    <h1>Lista de Ventas</h1>
    <div class="mb-3">
        <form method="GET" action="{{ route('ventas.index') }}">
            <input type="text" name="search" placeholder="Buscar ventas..." value="{{ request('search') }}" class="form-control" oninput="this.form.submit()">
        </form>
    </div>
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
    <div class="d-flex justify-content-center mt-4">
        {{ $ventas->links('pagination::bootstrap-4') }}
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