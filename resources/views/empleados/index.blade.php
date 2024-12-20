@extends('layouts.app')

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
        padding: 10px 20px;
        color: var(--text-color);
        font-family: 'Poppins', sans-serif;
        font-weight: bold;
        letter-spacing: 1px;
        max-width: 1200px;
        margin: 0 auto;
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
        gap: 15px;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .navbar-links a {
        color: var(--secondary-color);
        text-decoration: none;
        text-transform: uppercase;
        font-weight: bold;
        padding: 8px 12px;
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

<!-- Contenido principal de la vista -->
<div class="container">
    <br>
    <h1>Lista de Empleados</h1>

    <!-- Formulario de búsqueda -->
    <form method="GET" action="{{ route('empleados.index') }}" class="form-inline mb-3">
        <input type="text" name="search" class="form-control" placeholder="Buscar empleado..." value="{{ request('search') }}" oninput="this.form.submit()">
    </form>

    <!-- Botón para agregar empleado -->
    <a href="{{ route('empleados.create') }}" class="btn btn-primary mb-3">Agregar Empleado</a>

    <!-- Tabla de empleados -->
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo Electrónico</th>
                <th>Puesto</th>
                <th>Fecha de Contratación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empleados as $empleado)
                <tr>
                    <td>{{ $empleado->persona->nombre }}</td>
                    <td>{{ $empleado->persona->apellido }}</td>
                    <td>{{ $empleado->correoElectronico }}</td>
                    <td>{{ $empleado->puesto }}</td>
                    <td>{{ $empleado->fechaContratacion }}</td>
                    <td>
                        <a href="{{ route('empleados.edit', $empleado->idEmpleado) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('empleados.destroy', $empleado->idEmpleado) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de eliminar este empleado?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginación con Bootstrap 4 -->
    <div class="d-flex justify-content-center">
        {{ $empleados->links('pagination::bootstrap-4') }}
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