<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grupo Industrial Vilycach</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <style>
        /* General Page Styles */
        body {
            background-color: #f4f4f4;
            color: #333;
            font-family: 'Poppins', sans-serif;
        }

        /* Navbar */
        .navbar {
            background-color: #b22222;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
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
            font-size: 0.9em; /* Reduce font size */
            text-transform: uppercase;
            letter-spacing: 0.05em;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: #ffd700 !important;
        }

        /* Hero Section */
        .hero-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-image: url('{{ asset("img/carrusel4.jpg") }}');
            background-size: cover;
            background-position: center;
            padding: 100px 0;
            color: #fff;
            text-align: center;
        }

        .hero-section h1 {
            font-size: 3em;
            font-weight: bold;
            color: #ffd700;
        }

        .hero-section h2 {
            font-size: 1.5em;
            color: #fff;
            margin-top: 10px;
        }

        /* Sections */
        .section-title {
            font-size: 2em;
            font-weight: bold;
            color: #b22222;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Card Styles */
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
        }

        .card-title {
            color: #b22222;
            font-weight: bold;
        }

        .card-body p {
            font-size: 0.9em;
            color: #333;
        }

        /* Footer */
        footer {
            background-color: #333;
            color: #fff;
            padding: 40px 0;
            font-size: 0.9em;
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

        /* Scroll-to-top Button */
        .scroll-to-top {
            display: none;
            position: fixed;
            bottom: 25px;
            right: 25px;
            width: 50px;
            height: 50px;
            text-align: center;
            color: #fff;
            background: #b22222;
            border-radius: 50%;
            z-index: 1000;
            transition: background-color 0.3s;
        }

        .scroll-to-top:hover {
            background-color: #8b0000;
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

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1>¡Bienvenidos a Vilycach!</h1>
            <h2>¡Construyamos juntos el futuro, ladrillo a ladrillo!</h2>
        </div>
    </section>

    <!-- Misión y Visión Section -->
    <section id="Mision" class="py-5">
        <div class="container">
            <h2 class="section-title">Misión y Visión</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Misión</h5>
                            <p>Nos dedicamos a la fabricación de ladrillos de alta calidad para la construcción, comprometidos con la sostenibilidad y la satisfacción de nuestros clientes.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Visión</h5>
                            <p>Ser la empresa líder en el sector de la fabricación de ladrillos, reconocida por la excelencia de nuestros productos y el compromiso con el medio ambiente.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Objetivo</h5>
                            <p>Mejorar continuamente la calidad de nuestros productos, optimizando los procesos con tecnología innovadora y sostenible.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Servicios Section -->
    <section id="Servicios" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title">Nuestros Servicios</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Fabricación a Medida</h5>
                            <p>Producción de ladrillos personalizados para proyectos específicos.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Entrega a Domicilio</h5>
                            <p>Distribución eficiente con entregas puntuales en la obra.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ladrillos Ecológicos</h5>
                            <p>Fabricados con materiales sostenibles y procesos que minimizan el impacto ambiental.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section with Map -->
    <section id="Contacto" class="py-5">
        <div class="container">
            <h2 class="section-title">Contáctanos</h2>
            <div class="row">
                <div class="col-md-6">
                    <p>Alternativa "B" (Comunidad Mamani), Av. Murillo y Final Av. Barrientos, Viacha</p>
                    <p>Teléfono: 22001800</p>
                    <p>Horario: 8 a.m. - 5 p.m.</p>
                </div>
                <div class="col-md-6">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8152.484180339703!2d-68.302787604476!3d-16.63450475463702!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x915edbd7fa5321e9%3A0xb28dba774a17ba52!2sGrupo%20Industrial%20Vilycach!5e0!3m2!1ses-419!2sbo!4v1727801153352!5m2!1ses-419!2sbo" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container py-4">
            <div class="footer-logo">Grupo Industrial Vilycach</div>
            <p>&copy; 2023 Vilycach. Todos los derechos reservados.</p>
            <div class="social-icons">
                <a href="https://www.facebook.com/profile.php?id=100064032765756"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="https://wa.me/+59176546965/?text=MasInformacion"><i class="fa-brands fa-whatsapp"></i></a>
                <a href="https://www.instagram.com/univalle_bolivia/"><i class="fa-brands fa-instagram"></i></a>
            </div>
        </div>
    </footer>

    <a href="#" class="scroll-to-top rounded">
        <i class="fas fa-chevron-up"></i>
    </a>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://kit.fontawesome.com/3288cf83f6.js" crossorigin="anonymous"></script>
    <script>
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