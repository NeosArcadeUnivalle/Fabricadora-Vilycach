@extends('layouts.app')

@section('content')
<style>
    /* Variables de color */
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

    /* Contenedor del gráfico */
    .chart-container {
        position: relative;
        margin: auto;
        padding: 20px;
        background-color: var(--chart-bg-color);
        border-radius: 10px;
        box-shadow: 0px 4px 8px var(--shadow-color);
        width: 90%;
        max-width: 1000px;
        text-align: center;
    }

    /* Título del gráfico */
    h1 {
        color: var(--secondary-color);
        font-size: 2.5em;
        margin-bottom: 20px;
        font-weight: bold;
        text-shadow: 1px 1px 3px var(--shadow-color);
    }

    /* Ajustes generales */
    body {
        background-color: #f9f9f9;
    }

    .chart-legend {
        font-size: 14px;
        color: var(--text-color);
        margin-top: 10px;
    }
</style>

<!-- Script para el toggle del menú en móvil -->
<script>
    function toggleNavbar() {
        const links = document.querySelector('.navbar-links');
        links.classList.toggle('active');
    }
</script>

<div class="container mt-5">
    <div class="chart-container">
        <h1 class="text-center">Productos más solicitados</h1>
        <canvas id="productosChart"></canvas>
        <div class="chart-legend">
            <p>Este gráfico muestra los productos más solicitados por los clientes, incluyendo su tipo de ladrillo.</p>
        </div>
    </div>
</div>

<!-- Agregar Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Obtener los datos del backend
    const productos = @json($productosMasVendidos->map(function($item) {
        return "{$item->nombreProducto} ({$item->tipoLadrillo})";
    })->values());
    const cantidades = @json($productosMasVendidos->pluck('cantidad'));

    // Configurar el gráfico
    const ctx = document.getElementById('productosChart').getContext('2d');
    const productosChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: productos,
            datasets: [{
                label: 'Cantidad de solicitudes',
                data: cantidades,
                backgroundColor: 'var(--chart-bar-color)',
                hoverBackgroundColor: 'var(--chart-bar-hover-color)',
                borderColor: 'rgba(0, 0, 0, 0.1)',
                borderWidth: 1,
                borderRadius: 5,
                barThickness: 50
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        font: {
                            size: 14
                        },
                        color: 'var(--text-color)'
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `Cantidad: ${context.raw}`;
                        }
                    }
                }
            },
            layout: {
                padding: 20
            },
            scales: {
                x: {
                    ticks: {
                        color: 'var(--text-color)',
                        font: {
                            size: 14
                        }
                    },
                    grid: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: 'var(--text-color)',
                        font: {
                            size: 14
                        }
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)'
                    }
                }
            }
        }
    });
</script>
@endsection