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
</style>

<script>
    function toggleNavbar() {
        const links = document.querySelector('.navbar-links');
        links.classList.toggle('active');
    }
</script>
<div class="container">
    <br>
        <h1>Lista de Materias Primas y Proveedores</h1>
        <form method="GET" action="{{ route('materiaprima.index') }}" class="form-inline mb-3">
            <input type="text" name="search" class="form-control" placeholder="Buscar proveedor o materia prima..." value="{{ request('search') }}" oninput="this.form.submit()">
        </form>
        <a href="{{ route('materiaprima.create') }}" class="btn btn-primary mb-3">Agregar Materia Prima y Proveedor</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre del Proveedor</th>
                    <th>Dirección</th>
                    <th>Materia Prima</th>
                    <th>Cantidad</th>
                    <th>Fecha de Última Compra</th>
                    <th>Acciones</th>
                    <th>Contacto de Compra</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materiasPrimas as $materia)
                    <tr>
                        <td>{{ $materia->proveedor->nombreProveedor }}</td>
                        <td>{{ $materia->proveedor->direccionProveedor }}</td>
                        <td>{{ $materia->nombreMateriaPrima }}</td>
                        <td>{{ $materia->cantidadDisponible }}</td>
                        <td>{{ $materia->fechaUltimaCompra }}</td>
                        <td>
                            <a href="{{ route('materiaprima.edit', $materia->idMaterial) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('materiaprima.destroy', $materia->idMaterial) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de eliminar este proveedor y materia prima? Esta acción no se puede deshacer.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                        <td>{{ $materia->proveedor->telefonoProveedor }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $materiasPrimas->links('pagination::bootstrap-4') }}
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