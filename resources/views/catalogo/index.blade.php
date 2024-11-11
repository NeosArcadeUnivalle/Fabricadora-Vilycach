<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grupo Industrial Vilycach</title>
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
        }
        .precio {
        font-size: 26px; /* Aumenta el tamaño de la fuente */
        font-weight: bold;
        color: #e74c3c;
        margin-top: 15px; /* Espacio superior */
        margin-bottom: 15px; /* Espacio inferior */
        text-align: left; /* Alineado a la izquierda */
        }
    </style>
</head>
<body>
 
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center">
                <img src="img/logo-fotor-2024092416012.png" alt="Logo">
                <span>Vilycach</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="/">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="/ventas/create">Comprar</a></li>
                    <li class="nav-item"><a class="nav-link" href="/catalogo">Catálogo</a></li>
                    <li class="nav-item"><a class="nav-link" href="/empleado/login">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
 
    <h1>Catálogo de Productos</h1>
    <div class="catalogo-container">
 
        <!-- Producto 1: Ladrillo Rayado -->
        <div class="catalogo-item">
            <a href="img/Rayado6.png" data-fancybox="gallery" data-caption="Ladrillo Rayado">
                <img src="img/Rayado6.png" alt="Ladrillo Rayado">
            </a>
            <div class="details">
                <h2>Ladrillo Rayado</h2>
                <p class="section-title">Descripción</p>
                <p>Cerámica rectangular de 6 huecos en la cara frontal.</p>
                <p class="section-title">Datos Físicos</p>
                <p>Color: Naranja</p>
                <p class="section-title">Dimensiones</p>
                <p>Alto: 15 cm, Largo: 25 cm, Ancho: 10 cm</p>
                <p class="precio">Bs. 0.68</p>
                <form action="/catalogo/comprar" method="POST">
                   
                    <input type="hidden" name="idProducto" value="1">
                    <div class="quantity-container">
                        <button type="button" onclick="updateQuantity(-1, 'quantity13')">-</button>
                        <input type="text" id="quantity13" name="cantidad" value="1" min="1">
                        <button type="button" onclick="updateQuantity(1, 'quantity13')">+</button>
                        <button type="button" class="add-to-cart-btn" onclick="comprarProducto(13, 'quantity13')">Comprar!</button>
                    </div>
                </form>
            </div>
        </div>
 
        <!-- Producto 2: Ladrillo Liso -->
        <div class="catalogo-item">
            <a href="img/Liso6.png" data-fancybox="gallery" data-caption="Ladrillo Liso">
                <img src="img/Liso6.png" alt="Ladrillo Liso">
            </a>
            <div class="details">
                <h2>Ladrillo Liso</h2>
                <p class="section-title">Descripción</p>
                <p>Producto de acabado liso con 2 líneas de costado, presenta 6 orificios en la parte frontal y posterior.</p>
                <p class="section-title">Datos Físicos</p>
                <p>Color: Terracota</p>
                <p class="section-title">Dimensiones</p>
                <p>Alto: 15 cm, Largo: 25 cm, Ancho: 10 cm</p>
                <p class="precio">Bs. 0.67</p>
                <form action="/catalogo/comprar" method="POST">
                    <input type="hidden" name="idProducto" value="2">
                    <div class="quantity-container">
                        <button type="button" onclick="updateQuantity(-1, 'quantity3')">-</button>
                        <input type="text" id="quantity3" name="cantidad" value="1" min="1">
                        <button type="button" onclick="updateQuantity(1, 'quantity3')">+</button>
                        <button type="button" class="add-to-cart-btn" onclick="comprarProducto(3, 'quantity3')">Comprar!</button>
                    </div>
                </form>
            </div>
        </div>
 
        <!-- Producto 3: Ladrillo Gambote -->
        <div class="catalogo-item">
            <a href="img/Gambote18.png" data-fancybox="gallery" data-caption="Ladrillo Gambote">
                <img src="img/Gambote18.png" alt="Ladrillo Gambote">
            </a>
            <div class="details">
                <h2>Ladrillo Gambote</h2>
                <p class="section-title">Descripción</p>
                <p>Cerámica rectangular con 18 huecos redondos en la cara superior y liso en sus caras.</p>
                <p class="section-title">Datos Físicos</p>
                <p>Color: Naranja</p>
                <p class="section-title">Dimensiones</p>
                <p>Alto: 7.0 cm, Largo: 25 cm, Ancho: 12 cm</p>
                <p class="precio">Bs. 2.1</p>
                <form action="/catalogo/comprar" method="POST">
                    <input type="hidden" name="idProducto" value="3">
                    <div class="quantity-container">
                        <button type="button" onclick="updateQuantity(-1, 'quantity5')">-</button>
                        <input type="text" id="quantity5" name="cantidad" value="1" min="1">
                        <button type="button" onclick="updateQuantity(1, 'quantity5')">+</button>
                        <button type="button" class="add-to-cart-btn" onclick="comprarProducto(5, 'quantity5')">Comprar!</button>
                    </div>
                </form>
            </div>
        </div>
 
        <!-- Producto 4: Ladrillo Bota Agua Dos Caídas -->
        <div class="catalogo-item">
            <a href="img/Bota5.png" data-fancybox="gallery" data-caption="Ladrillo Bota Agua Dos Caídas">
                <img src="img/Bota5.png" alt="Ladrillo Bota Agua Dos Caídas">
            </a>
            <div class="details">
                <h2>Ladrillo Bota Agua Dos Caídas</h2>
                <p class="section-title">Descripción</p>
                <p>Cerámica rectangular con 5 huecos de diferentes tamaños en la cara frontal, liso en todas sus caras.</p>
                <p class="section-title">Datos Físicos</p>
                <p>Color: Terracota</p>
                <p class="section-title">Dimensiones</p>
                <p>Alto: 9.5 cm, Largo: 24.5 cm, Ancho: 24.5 cm</p>
                <p class="precio">Bs. 2.30</p>
                <form action="/catalogo/comprar" method="POST">
                    <input type="hidden" name="idProducto" value="4">
                    <div class="quantity-container">
                        <button type="button" onclick="updateQuantity(-1, 'quantity16')">-</button>
                        <input type="text" id="quantity16" name="cantidad" value="1" min="1">
                        <button type="button" onclick="updateQuantity(1, 'quantity16')">+</button>
                        <button type="button" class="add-to-cart-btn" onclick="comprarProducto(16, 'quantity16')">Comprar!</button>
                    </div>
                </form>
            </div>
        </div>
 
        <!-- Producto 5: Bota Agua Una Caída -->
        <div class="catalogo-item">
            <a href="img/Caida.png" data-fancybox="gallery" data-caption="Bota Agua Una Caída">
                <img src="img/Caida.png" alt="Bota Agua Una Caída">
            </a>
            <div class="details">
                <h2>Bota Agua Una Caída</h2>
                <p class="section-title">Descripción</p>
                <p>Cerámica rectangular con 4 huecos de diferentes tamaños en la cara frontal, liso en todas sus caras.</p>
                <p class="section-title">Datos Físicos</p>
                <p>Color: Terracota</p>
                <p class="section-title">Dimensiones</p>
                <p>Alto: 17.5 cm, Largo: 24 cm, Ancho: 9.5 cm</p>
                <p class="precio">Bs. 2.20</p>
                <form action="/catalogo/comprar" method="POST">
                    <input type="hidden" name="idProducto" value="5">
                    <div class="quantity-container">
                        <button type="button" onclick="updateQuantity(-1, 'quantity4')">-</button>
                        <input type="text" id="quantity4" name="cantidad" value="1" min="1">
                        <button type="button" onclick="updateQuantity(1, 'quantity4')">+</button>
                        <button type="button" class="add-to-cart-btn" onclick="comprarProducto(4, 'quantity4')">Comprar!</button>
                    </div>
                </form>
            </div>
        </div>
 
        <!-- Producto 6: Ladrillo Pavic -->
        <div class="catalogo-item">
            <a href="img/Pavic.png" data-fancybox="gallery" data-caption="Ladrillo Pavic">
                <img src="img/Pavic.png" alt="Ladrillo Pavic">
            </a>
            <div class="details">
                <h2>Ladrillo Pavic</h2>
                <p class="section-title">Descripción</p>
                <p>Pieza cerámica para acabados que demandan resistencias y durabilidad altas, rústico por sus cuatro caras.</p>
                <p class="section-title">Datos Físicos</p>
                <p>Color: Naranja</p>
                <p class="section-title">Dimensiones</p>
                <p>Alto: 4.5 cm, Largo: 20 cm, Ancho: 10 cm</p>
                <p class="precio">Bs. 2.00</p>
                <form action="/catalogo/comprar" method="POST">
                    <input type="hidden" name="idProducto" value="6">
                    <div class="quantity-container">
                        <button type="button" onclick="updateQuantity(-1, 'quantity12')">-</button>
                        <input type="text" id="quantity12" name="cantidad" value="1" min="1">
                        <button type="button" onclick="updateQuantity(1, 'quantity12')">+</button>
                        <button type="button" class="add-to-cart-btn" onclick="comprarProducto(12, 'quantity12')">Comprar!</button>
                    </div>
                </form>
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
            Toolbar: { display: ["zoom", "download", "fullscreen", "close"] },
            Image: { zoom: true }
        });

        function comprarProducto(idProducto, inputCantidadId) {
        const cantidad = document.getElementById(inputCantidadId).value;
        if (cantidad < 1) {
            alert('Por favor, seleccione una cantidad válida.');
            return;
        }
        // Redirige a la ruta ventas/create con los parámetros producto_id y cantidad
        window.location.href = `/ventas/create?producto_id=${idProducto}&cantidad=${cantidad}`;
        }

        window.location.href = `/ventas/create?producto_id=${idProducto}&cantidad=${cantidad}`;
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