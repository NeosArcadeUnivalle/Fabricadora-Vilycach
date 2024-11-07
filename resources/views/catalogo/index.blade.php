<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4/dist/fancybox.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
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
 
        .catalogo-container {
            width: 90%;
            max-width: 1200px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            justify-content: center;
            padding-bottom: 40px;
        }
 
        .catalogo-item {
            display: flex;
            align-items: center;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: transform 0.2s;
            border-left: 5px solid #b22222;
            flex-wrap: wrap;
        }
 
        .catalogo-item:hover {
            transform: scale(1.02);
        }
 
        .catalogo-item img {
            max-width: 200px;
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-right: 20px;
            cursor: pointer;
        }
 
        .catalogo-item .details {
            flex-grow: 1;
            max-width: 100%;
        }
 
        .catalogo-item h2 {
            font-size: 24px;
            color: #b22222;
            margin-bottom: 5px;
        }
 
        .section-title {
            font-weight: bold;
            color: #444;
            margin-top: 15px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
 
        .precio {
            font-size: 22px;
            font-weight: bold;
            color: #e74c3c;
            margin: 10px 0;
            text-align: right;
        }
 
        .quantity-container {
            display: flex;
            align-items: center;
            margin-top: 10px;
            flex-wrap: wrap;
        }
 
        .quantity-container input {
            width: 50px;
            text-align: center;
            font-size: 16px;
            border: 2px solid #b22222;
            border-radius: 4px;
            margin: 0 5px;
        }
 
        .quantity-container button {
            background-color: #b22222;
            color: #fff;
            border: none;
            padding: 5px 10px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
 
        .quantity-container button:hover {
            background-color: #a02020;
        }
 
        .add-to-cart-btn {
            background-color: #b22222;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-left: 15px;
            transition: background-color 0.3s;
            font-weight: bold;
            white-space: nowrap;
        }
 
        .add-to-cart-btn:hover {
            background-color: #a02020;
        }
 
        footer {
            background-color: #333;
            color: #fff;
            padding: 40px 0;
            font-size: 0.9em;
            width: 100%;
            text-align: center;
        }
 
        footer .footer-logo {
            font-weight: bold;
            color: #ffd700;
            font-size: 1.5em;
        }
 
        footer .social-icons a {
            color: #ffd700;
            margin: 0 10px;
            font-size: 1.2em;
            transition: color 0.3s;
        }
 
        footer .social-icons a:hover {
            color: #b22222;
        }
 
        .scroll-to-top {
            display: none;
            position: fixed;
            bottom: 25px;
            right: 25px;
            color: #ffd700;
            font-size: 1.5em;
            z-index: 1000;
        }
 
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .catalogo-item {
                flex-direction: column;
                align-items: flex-start;
                padding: 15px;
            }
 
            .catalogo-item img {
                margin-right: 0;
                margin-bottom: 15px;
                max-width: 100%;
            }
 
            .quantity-container, .add-to-cart-btn {
                width: 100%;
                justify-content: space-between;
            }
 
            .precio {
                text-align: left;
            }
        }
    </style>
</head>
<body>
 
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center">
                <img src="{{ asset('img/logo-fotor-2024092416012.png') }}" alt="Logo">
                <span>Vilycach</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
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
        </div>
    </nav>
 
    <h1>Catálogo de Productos</h1>
    <div class="catalogo-container">
     <!-- Producto 1 -->
     <div class="catalogo-item">
        <a href="{{ asset('img/Rayado6.jpg') }}" data-fancybox="gallery" data-caption="Ladrillo Rayado">
            <img src="{{ asset('img/Rayado6.jpg') }}" alt="Ladrillo Rayado">
        </a>
        <div class="details">
            <h2>Ladrillo Rayado</h2>
            <p class="section-title">Descripción</p>
            <p>Cerámica rectangular de 6 huecos en la cara frontal.</p>
            <p class="section-title">Datos Físicos</p>
            <p>Color: Naranja</p>
            <p>Acabado: Textura de la superficie con estrías en todas sus caras.</p>
            <p class="section-title">Dimensiones</p>
            <p>Alto: 15 cm, Largo: 25 cm, Ancho: 10 cm, Peso: 2,7 Kg</p>
            <p class="section-title">Rendimiento</p>
            <p>23 Pzas/m2</p>
            <p class="precio">Bs. 0.90</p>
            <div class="quantity-container">
                <button onclick="updateQuantity(-1, 'quantityRayado')">-</button>
                <input type="text" id="quantityRayado" value="1" min="1">
                <button onclick="updateQuantity(1, 'quantityRayado')">+</button>
                <button class="add-to-cart-btn">Comprar!</button>
            </div>
        </div>
    </div>
 
    <!-- Producto 2 -->
    <div class="catalogo-item">
        <a href="{{ asset('img/Liso6.jpg') }}" data-fancybox="gallery" data-caption="Ladrillo Liso">
            <img src="{{ asset('img/Liso6.jpg') }}" alt="Ladrillo Liso">
        </a>
        <div class="details">
            <h2>Ladrillo Liso</h2>
            <p class="section-title">Descripción</p>
            <p>Producto de acabado liso con 2 líneas de costado, presenta 6 orificios en la parte frontal y posterior.</p>
            <p class="section-title">Datos Físicos</p>
            <p>Color: Terracota</p>
            <p>Acabado: Textura de la superficie lisa en todas sus caras.</p>
            <p class="section-title">Dimensiones</p>
            <p>Alto: 15 cm, Largo: 25 cm, Ancho: 10 cm, Peso: 2,7 Kg</p>
            <p class="section-title">Rendimiento</p>
            <p>23 Pzas/m2</p>
            <p class="precio">Bs. 1.00</p>
            <div class="quantity-container">
                <button onclick="updateQuantity(-1, 'quantityLiso')">-</button>
                <input type="text" id="quantityLiso" value="1" min="1">
                <button onclick="updateQuantity(1, 'quantityLiso')">+</button>
                <button class="add-to-cart-btn">Comprar!</button>
            </div>
        </div>
    </div>
 
    <!-- Producto 3 -->
    <div class="catalogo-item">
        <a href="{{ asset('img/Gambote18.jpg') }}" data-fancybox="gallery" data-caption="Ladrillo Gambote">
            <img src="{{ asset('img/Gambote18.jpg') }}" alt="Ladrillo Gambote">
        </a>
        <div class="details">
            <h2>Ladrillo Gambote</h2>
            <p class="section-title">Descripción</p>
            <p>Cerámica rectangular con 18 huecos redondos en la cara superior y liso en sus caras.</p>
            <p class="section-title">Datos Físicos</p>
            <p>Color: Naranja</p>
            <p>Acabado: Textura lisa en los laterales de la pieza.</p>
            <p class="section-title">Dimensiones</p>
            <p>Alto: 7,0 cm, Largo: 25 cm, Ancho: 12 cm, Peso: 2,35 Kg</p>
            <p class="section-title">Rendimiento</p>
            <p>45 Pzas/m2</p>
            <p class="precio">Bs. 1.17</p>
            <div class="quantity-container">
                <button onclick="updateQuantity(-1, 'quantityGambote')">-</button>
                <input type="text" id="quantityGambote" value="1" min="1">
                <button onclick="updateQuantity(1, 'quantityGambote')">+</button>
                <button class="add-to-cart-btn">Comprar!</button>
            </div>
        </div>
    </div>
 
    <!-- Producto 4 -->
    <div class="catalogo-item">
        <a href="{{ asset('img/Bota5.jpg') }}" data-fancybox="gallery" data-caption="Ladrillo Bota Agua">
            <img src="{{ asset('img/Bota5.jpg') }}" alt="Ladrillo Bota Agua">
        </a>
        <div class="details">
            <h2>Ladrillo Bota Agua</h2>
            <p class="section-title">Descripción</p>
            <p>Cerámica rectangular con 5 huecos de diferentes tamaños en la cara frontal, liso en todas sus caras.</p>
            <p class="section-title">Datos Físicos</p>
            <p>Color: Terracota</p>
            <p>Acabado: Textura de la superficie lisa en todas sus caras.</p>
            <p class="section-title">Dimensiones</p>
            <p>Alto: 9,5 cm, Largo: 24,5 cm, Ancho: 24,5 cm, Peso: 3,175 Kg</p>
            <p class="section-title">Rendimiento</p>
            <p>4 Pzas/m2</p>
            <p class="precio">Bs. 2.84</p>
            <div class="quantity-container">
                <button onclick="updateQuantity(-1, 'quantityBota')">-</button>
                <input type="text" id="quantityBota" value="1" min="1">
                <button onclick="updateQuantity(1, 'quantityBota')">+</button>
                <button class="add-to-cart-btn">Comprar!</button>
            </div>
        </div>
    </div>
 
    <!-- Producto 5 -->
    <div class="catalogo-item">
        <a href="{{ asset('img/Caida.jpg') }}" data-fancybox="gallery" data-caption="Bota Agua Una Caída">
            <img src="{{ asset('img/Caida.jpg') }}" alt="Bota Agua Una Caída">
        </a>
        <div class="details">
            <h2>Bota Agua Una Caída</h2>
            <p class="section-title">Descripción</p>
            <p>Cerámica rectangular con 4 huecos de diferentes tamaños en la cara frontal, liso en todas sus caras.</p>
            <p class="section-title">Datos Físicos</p>
            <p>Color: Terracota</p>
            <p>Acabado: Textura de la superficie lisa en todas sus caras.</p>
            <p class="section-title">Dimensiones</p>
            <p>Alto: 17,5 cm, Largo: 24 cm, Ancho: 9,5 cm, Peso: 2,6 Kg</p>
            <p class="section-title">Rendimiento</p>
            <p>4 Pzas/m2</p>
            <p class="precio">Bs. 2.36</p>
            <div class="quantity-container">
                <button onclick="updateQuantity(-1, 'quantityCaida')">-</button>
                <input type="text" id="quantityCaida" value="1" min="1">
                <button onclick="updateQuantity(1, 'quantityCaida')">+</button>
                <button class="add-to-cart-btn">Comprar!</button>
            </div>
        </div>
    </div>
    </div>
 
    <!-- Footer -->
    <footer>
        <div class="container py-4">
            <div class="footer-logo">Grupo Industrial Vilycach</div>
            <p>&copy; 2024 Vilycach. Todos los derechos reservados.</p>
            <div class="social-icons">
                <a href="https://www.facebook.com/profile.php?id=100064032765756"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="https://wa.me/+59176546965/?text=MasInformacion"><i class="fa-brands fa-whatsapp"></i></a>
                <a href="https://www.instagram.com/univalle_bolivia/"><i class="fa-brands fa-instagram"></i></a>
            </div>
        </div>
    </footer>
 
    <a href="#" class="scroll-to-top">
        <i class="fas fa-chevron-up"></i>
    </a>
 
    <script src="https://kit.fontawesome.com/3288cf83f6.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4/dist/fancybox.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        Fancybox.bind("[data-fancybox='gallery']", {
            Toolbar: {
                display: ["zoom", "download", "fullscreen", "close"],
            },
            Image: {
                zoom: true,
            }
        });
 
        function updateQuantity(amount, inputId) {
            const input = document.getElementById(inputId);
            let currentValue = parseInt(input.value);
            if (isNaN(currentValue)) currentValue = 1;
 
            let newValue = currentValue + amount;
            if (newValue < 1) newValue = 1;
 
            input.value = newValue;
        }
 
        document.addEventListener('DOMContentLoaded', function () {
            const scrollBtn = document.querySelector('.scroll-to-top');
            window.addEventListener('scroll', function () {
                scrollBtn.style.display = window.scrollY > 100 ? 'block' : 'none';
            });
            scrollBtn.addEventListener('click', function (e) {
                e.preventDefault();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        });
    </script>
 
</body>
</html>