<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Productos</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        /* Estilos generales */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            width: 100%;
            margin: 20px 0;
        }

        /* Navbar */
        .navbar {
            background-color: #b22222;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
        }

        .navbar-brand {
            font-weight: bold;
            color: #ffd700 !important;
            font-size: 1.8em;
        }

        .navbar-brand img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }

        .nav-link {
            color: #fff !important;
            font-weight: 600;
            font-size: 0.9em;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: #ffd700 !important;
        }

        /* Contenedor del catálogo */
        .catalogo-container {
            width: 90%;
            max-width: 1400px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            justify-content: center;
            padding-bottom: 40px;
        }

        /* Tarjeta de producto */
        .catalogo-item {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            transition: transform 0.2s;
        }

        .catalogo-item:hover {
            transform: translateY(-5px);
        }

        .catalogo-item img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            max-height: 200px;
        }

        .catalogo-item h2 {
            font-size: 18px;
            margin: 10px 0;
            color: #34495e;
        }

        .precio {
            font-size: 20px;
            font-weight: bold;
            color: #e74c3c;
            margin-top: 10px;
        }

        /* Estilos del botón de detalles */
        .details-btn {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            color: #fff;
            background-color: #3498db;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s;
            cursor: pointer;
        }

        .details-btn:hover {
            background-color: #2980b9;
        }

        /* Estilos del modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            max-width: 500px;
            width: 100%;
            text-align: left;
            position: relative;
        }

        .modal-content img {
            max-width: 100%;
            border-radius: 8px;
        }

        .modal-content h2 {
            margin-top: 10px;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('img/logo-fotor-2024092416012.png') }}" alt="Logo">
            Vilycach
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/ventas/create">Comprar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/catalogo">Catálogo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/empleado/login">Login</a>
                </li>
            </ul>
        </div>
    </nav>

    <h1>Catálogo de Productos</h1>
    <div class="catalogo-container">
        <!-- Producto 1 -->
        <div class="catalogo-item">
            <img src="{{ asset('img/Rayado6.jpg') }}" alt="Ladrillo Rayado">
            <h2>Ladrillo Rayado</h2>
            <p>Descripción breve del ladrillo rayado.</p>
            <button class="details-btn" onclick="openModal('Rayado')">Más Detalles</button>
        </div>

        <!-- Producto 2 -->
        <div class="catalogo-item">
            <img src="{{ asset('img/Liso6.jpg') }}" alt="Ladrillo Liso">
            <h2>Ladrillo Liso</h2>
            <p>Descripción breve del ladrillo liso.</p>
            <button class="details-btn" onclick="openModal('Liso')">Más Detalles</button>
        </div>

        <!-- Producto 3 -->
        <div class="catalogo-item">
            <img src="{{ asset('img/Bota5.jpg') }}" alt="Ladrillo Bota Agua">
            <h2>Ladrillo Bota Agua</h2>
            <p>Descripción breve del ladrillo bota agua.</p>
            <button class="details-btn" onclick="openModal('BotaAgua')">Más Detalles</button>
        </div>

        <!-- Producto 4 -->
        <div class="catalogo-item">
            <img src="{{ asset('img/Gambote18.jpg') }}" alt="Ladrillo Gambote">
            <h2>Ladrillo Gambote</h2>
            <p>Descripción breve del ladrillo gambote.</p>
            <button class="details-btn" onclick="openModal('Gambote')">Más Detalles</button>
        </div>
    </div>

    <!-- Modales individuales para cada producto -->
    <div class="modal" id="modalRayado">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal('Rayado')">&times;</span>
            <img src="{{ asset('img/Rayado6.jpg') }}" alt="Ladrillo Rayado">
            <h2>Ladrillo Rayado</h2>
            <p>Peso: 2.8 kg, Alto: 15 cm, Largo: 24 cm, Ancho: 10 cm.</p>
        </div>
    </div>

    <div class="modal" id="modalLiso">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal('Liso')">&times;</span>
            <img src="{{ asset('img/Liso6.jpg') }}" alt="Ladrillo Liso">
            <h2>Ladrillo Liso</h2>
            <p>Peso: 2.7 kg, Alto: 15 cm, Largo: 24 cm, Ancho: 10 cm.</p>
        </div>
    </div>

    <div class="modal" id="modalBotaAgua">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal('BotaAgua')">&times;</span>
            <img src="{{ asset('img/Bota5.jpg') }}" alt="Ladrillo Bota Agua">
            <h2>Ladrillo Bota Agua</h2>
            <p>Peso: 3.2 kg, Alto: 9 cm, Largo: 25 cm, Ancho: 23 cm.</p>
        </div>
    </div>

    <div class="modal" id="modalGambote">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal('Gambote')">&times;</span>
            <img src="{{ asset('img/Gambote18.jpg') }}" alt="Ladrillo Gambote">
            <h2>Ladrillo Gambote</h2>
            <p>Peso: 2.1 kg, Alto: 12 cm, Largo: 25 cm, Ancho: 7 cm.</p>
        </div>
    </div>

    <script>
        function openModal(modalId) {
            const modal = document.getElementById('modal' + modalId);
            if (modal) {
                modal.style.display = 'flex';
            } else {
                console.error('Modal no encontrado:', modalId);
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById('modal' + modalId);
            if (modal) {
                modal.style.display = 'none';
            }
        }
    </script>

</body>
</html>