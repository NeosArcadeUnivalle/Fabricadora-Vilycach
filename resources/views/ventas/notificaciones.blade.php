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
    .list-group-item.font-weight-bold {
        font-weight: bold; 
    }
    .list-group-item.text-muted.bg-light {
        background-color: #f8f9fa; 
        color: #6c757d; 
    }
</style>
<div class="container">
    <h1>Notificaciones</h1>
    <form action="{{ route('notificaciones.marcarVistas') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary mb-3">Marcar todas como vistas</button>
    </form>
    <ul class="list-group">
        @forelse ($notificaciones as $notificacion)
            <li class="list-group-item {{ $notificacion['visto'] ? 'text-muted bg-light' : 'font-weight-bold' }}">
                {{ $notificacion['mensaje'] }}
            </li>
        @empty
            <li class="list-group-item">No hay notificaciones.</li>
        @endforelse
    </ul>
</div>
@endsection