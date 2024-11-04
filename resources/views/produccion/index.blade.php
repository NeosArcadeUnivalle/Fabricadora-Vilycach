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
        <h2>Lista de Producción</h2>

        <!-- Formulario de búsqueda -->
        <form method="GET" action="{{ route('produccion.index') }}" class="form-inline mb-3">
            <input type="text" name="search" class="form-control" placeholder="Buscar producción..." value="{{ request('search') }}" oninput="this.form.submit()">
        </form>

        <a href="{{ route('produccion.create') }}" class="btn btn-primary mb-3">Agregar Producción</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Cantidad Producida</th>
                    <th>Empleado Responsable</th>
                    <th>Producto</th>
                    <th>Tipo de Ladrillo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($producciones as $produccion)
                    <tr>
                        <td>{{ $produccion->fecha }}</td>
                        <td>{{ $produccion->cantidadProducida }}</td>
                        <td>
                            {{ optional(optional($produccion->empleadoResponsable)->persona)->nombre }} 
                            {{ optional(optional($produccion->empleadoResponsable)->persona)->apellido }}
                        </td>
                        <td>{{ optional($produccion->producto)->nombreProducto }}</td>
                        <td>{{ optional(optional($produccion->producto)->tipoLadrillo)->tipoLadrillo }}</td>
                        <td>
                            <a href="{{ route('produccion.edit', $produccion->idProduccion) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('produccion.destroy', $produccion->idProduccion) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Paginación -->
        <div class="d-flex justify-content-center">
            {{ $producciones->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection