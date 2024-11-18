@extends('layouts.app')

@section('content')
<style>
        :root {
        --primary-color: #f4f4f4; /* Fondo claro */
        --secondary-color: #b22222; /* Rojo oscuro */
        --hover-color: #8b0000; /* Hover */
        --text-color: #333; /* Color de texto */
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
        padding: 10px 20px;
        color: var(--text-color);
        font-family: 'Poppins', sans-serif;
        font-weight: bold;
        letter-spacing: 1px;
        max-width: 1200px;
        margin: 0 auto;
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
    /* Estilos generales */
    .chart-container {
        margin: 20px auto;
        padding: 20px;
        background: #f4f4f4;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        max-width: 90%;
        text-align: center;
    }

    .chart-title {
        font-size: 1.8em;
        font-weight: bold;
        color: #b22222;
        margin-bottom: 10px;
    }

    .chart-legend {
        font-size: 0.9em;
        color: #666;
        margin-top: 10px;
    }

    .chart-description {
        font-size: 0.85em;
        color: #666;
        margin-top: 15px;
    }

    /* Ajuste del gráfico circular */
    .chart-container-pie {
        max-width: 600px;
        margin: 0 auto 20px;
    }
</style>

<div class="container mt-5">
    <!-- Gráfico 1 -->
    <div class="chart-container">
        <h2 class="chart-title">Productos Más Vendidos Según La Cantidad</h2>
        <canvas id="productosMasVendidosChart"></canvas>
        <p class="chart-description">Este gráfico muestra los productos más vendidos según la cantidad total adquirida por los clientes, clasificando por tipo de ladrillo.</p>
    </div>

    <!-- Gráfico 2 -->
    <div class="chart-container">
        <h2 class="chart-title">Solicitudes de Productos</h2>
        <canvas id="productosMasSolicitadosChart"></canvas>
        <p class="chart-description">Este gráfico ilustra el número de solicitudes realizadas para cada tipo de producto, agrupando por su categoría.</p>
    </div>

    <!-- Gráfico 3 -->
    <div class="chart-container chart-container-pie">
        <h2 class="chart-title">Ciudades con Mayor Cantidad de Solicitudes</h2>
        <canvas id="ciudadesChart"></canvas>
        <p class="chart-description">Este gráfico muestra las ciudades desde las cuales se realizan la mayor cantidad de solicitudes de compra.</p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Gráfico 1: Productos Más Vendidos
    const productosVendidos = @json($productosMasVendidos->map(function($item) {
        return "{$item->nombreProducto} ({$item->tipoLadrillo})";
    }));
    const cantidadesVendidas = @json($productosMasVendidos->pluck('cantidad_total'));

    new Chart(document.getElementById('productosMasVendidosChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: productosVendidos,
            datasets: [{
                label: 'Cantidad Vendida',
                data: cantidadesVendidas,
                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                hoverBackgroundColor: 'rgba(75, 192, 192, 0.8)',
                borderWidth: 1,
                barThickness: 50
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        }
    });

    // Gráfico 2: Solicitudes de Productos
    const productosSolicitados = @json($productosMasSolicitados->map(function($item) {
        return "{$item->nombreProducto} ({$item->tipoLadrillo})";
    }));
    const solicitudes = @json($productosMasSolicitados->pluck('solicitudes'));

    new Chart(document.getElementById('productosMasSolicitadosChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: productosSolicitados,
            datasets: [{
                label: 'Solicitudes',
                data: solicitudes,
                backgroundColor: 'rgba(153, 102, 255, 0.5)',
                hoverBackgroundColor: 'rgba(153, 102, 255, 0.8)',
                borderWidth: 1,
                barThickness: 50
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        }
    });

    // Gráfico 3: Ciudades con Mayor Solicitudes
    const ciudades = @json($ciudadesMasSolicitadas->pluck('ciudad'));
    const solicitudesCiudades = @json($ciudadesMasSolicitadas->pluck('cantidad'));

    new Chart(document.getElementById('ciudadesChart').getContext('2d'), {
        type: 'pie',
        data: {
            labels: ciudades,
            datasets: [{
                data: solicitudesCiudades,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        }
    });
</script>
@endsection