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

    .chart-container {
        margin: 20px auto;
        padding: 20px;
        background: var(--primary-color);
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        max-width: 80%;
        text-align: center;
    }

    .chart-title {
        font-size: 1.8em;
        font-weight: bold;
        color: var(--secondary-color);
        margin-bottom: 10px;
    }

    .chart-description {
        font-size: 0.85em;
        color: #666;
        margin-top: 15px;
    }

    .chart-container-pie {
        max-width: 500px;
        margin: 0 auto 20px;
    }

    .chart-container-radar {
        max-width: 600px;
        margin: 0 auto 20px;
    }
</style>

<div class="container mt-5">
    <div class="chart-container">
        <h2 class="chart-title">Productos Más Vendidos por Cantidad</h2>
        <canvas id="productosMasVendidosChart"></canvas>
        <p class="chart-description">Este gráfico muestra los productos más vendidos junto con su tipo, basado en la cantidad total adquirida por los clientes.</p>
    </div>

    <div class="chart-container">
        <h2 class="chart-title">Solicitudes de Productos por Tipo</h2>
        <canvas id="productosMasSolicitadosChart"></canvas>
        <p class="chart-description">Este gráfico ilustra el número de solicitudes realizadas para cada producto junto con su tipo.</p>
    </div>

    <div class="chart-container chart-container-pie">
        <h2 class="chart-title">Ciudades con Mayor Cantidad de Solicitudes</h2>
        <canvas id="ciudadesChart"></canvas>
        <p class="chart-description">Este gráfico muestra las ciudades desde las cuales se realizan la mayor cantidad de solicitudes de compra.</p>
    </div>

    <div class="chart-container chart-container-radar">
        <h2 class="chart-title">Ventas por Categoría de Producto</h2>
        <canvas id="ventasPorCategoriaChart"></canvas>
        <p class="chart-description">Este gráfico representa las ventas totales por categoría de producto (tipo de ladrillo).</p>
    </div>

    <div class="chart-container">
        <h2 class="chart-title">Ingresos Totales por Mes</h2>
        <canvas id="ingresosPorMesChart"></canvas>
        <p class="chart-description">Este gráfico muestra los ingresos totales generados mes a mes.</p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const productosVendidos = @json($productosMasVendidos->pluck('nombreProducto'));
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
                legend: { display: true, position: 'top' }
            }
        }
    });

    const productosSolicitados = @json($productosMasSolicitados->pluck('nombreProducto'));
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
                legend: { display: true, position: 'top' }
            }
        }
    });

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
                legend: { display: true, position: 'top' }
            }
        }
    });

    const categorias = @json($ventasPorCategoria->pluck('tipoLadrillo'));
    const ventasTotales = @json($ventasPorCategoria->pluck('total_ventas'));

    new Chart(document.getElementById('ventasPorCategoriaChart').getContext('2d'), {
        type: 'radar',
        data: {
            labels: categorias,
            datasets: [{
                label: 'Total Ventas',
                data: ventasTotales,
                borderColor: 'rgba(255, 99, 132, 0.8)',
                backgroundColor: 'rgba(255, 99, 132, 0.3)',
                pointBackgroundColor: 'rgba(255, 99, 132, 0.8)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgba(255, 99, 132, 0.8)',
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true, position: 'top' }
            }
        }
    });

    const meses = @json($ingresosPorMes->pluck('mes'));
    const ingresos = @json($ingresosPorMes->pluck('ingresos_totales'));

    new Chart(document.getElementById('ingresosPorMesChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: meses,
            datasets: [{
                label: 'Ingresos Totales',
                data: ingresos,
                borderColor: 'rgba(255, 99, 132, 0.8)',
                backgroundColor: 'rgba(255, 99, 132, 0.3)',
                fill: true,
                borderWidth: 2,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true, position: 'top' }
            }
        }
    });
</script>
@endsection