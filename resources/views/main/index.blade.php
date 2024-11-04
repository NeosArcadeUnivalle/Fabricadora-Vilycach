
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clínica Odontológica</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <style>

        #imgC {
            width: 1000px;
            height: 800px;
        }

        #cardsi {
            width: 415px;
            height: 400px;
        }

        footer {
            width: 100%;
            height: 60px; /* Altura del footer */
            background-color: #f5f5f5;
            margin-top: auto;
        }

        #conte {
            max-width: 900px;
        }

        #icons {
            width: 50px;
        }

        /* Estilos para el botón de scroll hacia arriba */
        .scroll-to-top {
            display: none;
            position: fixed;
            bottom: 25px;
            right: 25px;
            width: 50px;
            height: 50px;
            text-align: center;
            color: #fff;
            background: #a82323;
            border-radius: 50px;
            z-index: 1000;
        }

            .scroll-to-top i {
                line-height: 50px;
            }

            .scroll-to-top:hover {
                background: #8d1818;
                color: white;
            }

    </style>
</head>
<body>

    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#" style="font-size:20px">
            <img src="{{ asset('img/logo-fotor-2024092416012.png') }}" width="60" height="60" class="d-inline-block align-top" alt="Logo">Vilycach
        </a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#Mision">Misión y Visión</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#Servicios">Nuestros servicios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#Equipo">Tipos de Ladrillos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/ventas/create" style="font-size:20px">Comprar</a>
                </li>
            </ul>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                <a class="nav-link" href="/empleado/login" style="font-size:20px">LOGIN</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Sección de bienvenida -->
    <section id="inicio" class="py-5 text-center">
        <div class="container">
            <h1>¡Bienvenidos a Vilycach!</h1>
            <h2>¡Construyamos juntos el futuro, ladrillo a ladrillo!</h2>
        </div>

        <!-- Agrega la estructura del carrusel con imágenes directamente en la vista -->
        <div class="container" id="conte">
            <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="5000">
                        <img src="{{ asset('img/carrusel5.jpg') }}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item" data-bs-interval="5000">
                        <img src="{{ asset('img/carrusel2.jpg') }}" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item" data-bs-interval="5000">
                        <img src="{{ asset('img/carrusel4.jpg') }}" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <!-- Misión y Visión -->
    <section id="Mision" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Misión y Visión</h2>
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Misión</h5>
                            <p class="card-text">
                                En Vilycach, nos dedicamos a la fabricación de ladrillos de alta calidad para la construcción, comprometidos con la innovación, la sostenibilidad y la satisfacción de nuestros clientes.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Visión</h5>
                            <p class="card-text">
                                Ser la empresa líder en el sector de la fabricación de ladrillos en el país, reconocida por la excelencia de nuestros productos y el compromiso con la sostenibilidad.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Objetivo</h5>
                            <p class="card-text">
                                Mejorar continuamente la calidad de nuestros productos, optimizando los procesos de producción mediante tecnologías innovadoras y sostenibles.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de servicios -->
    <section id="Servicios" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Nuestros Servicios</h2>
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Fabricación de Ladrillos a Medida</h5>
                            <p class="card-text">
                                Nos especializamos en la producción de ladrillos personalizados para satisfacer las necesidades específicas de cada proyecto.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Distribución y Entrega a Domicilio</h5>
                            <p class="card-text">
                                Ofrecemos un servicio de distribución eficiente, con entregas puntuales directamente en el lugar de la obra.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ladrillos Ecológicos</h5>
                            <p class="card-text">
                                Ofrecemos una línea de ladrillos ecológicos fabricados con materiales sostenibles y procesos que minimizan el impacto ambiental.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de equipo -->
    <section id="Equipo" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Tipos de Ladrillos</h2>
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('img/ladrillo6.png') }}" class="card-img-top" id="cardsi" alt="Ladrillo 6 Huecos">
                        <div class="card-body">
                            <h5 class="card-title">Ladrillo 6 Huecos</h5>
                            <p class="card-text">Terracota, acabado rayado. Dimensiones: 15 cm x 24 cm x 10 cm, Peso: 2,65 Kg.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('img/ladrillo18.png') }}" class="card-img-top" id="cardsi" alt="Ladrillo 18 Huecos">
                        <div class="card-body">
                            <h5 class="card-title">Ladrillo 18 Huecos</h5>
                            <p class="card-text">Terracota, acabado liso. Dimensiones: 7 cm x 24 cm x 12 cm, Peso: 2,35 Kg.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('img/ladrillo2Caidas.png') }}" class="card-img-top" id="cardsi" alt="Ladrillo Especial">
                        <div class="card-body">
                            <h5 class="card-title">Ladrillo Especial</h5>
                            <p class="card-text">Terracota, acabado liso. Dimensiones: 9,5 cm x 24,5 cm x 24,5 cm, Peso: 3,175 Kg.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de contacto -->
    <section id="Contacto" class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Contáctanos</h2>
            <div class="row">
                <div class="col-md-6">
                    <p>Alternativa "B" (Comunidad Mamani)/ Av. Murillo y Final Av. Barrientos, Viacha</p>
                    <p>Teléfono: 22001800</p>
                    <p>Horario: Abre a las 8 a.m. - 5 p.m.</p>
                </div>
                <div class="col-md-6">
                    <a href="https://www.facebook.com/profile.php?id=100064032765756">
                        <i class="fa-brands fa-square-facebook fa-2xl" style="color: #005eff;" id="icons"></i>
                    </a>
                    <a href="https://wa.me/+59176546965/?text=MasInformacion">
                        <i class="fa-brands fa-square-whatsapp fa-2xl" style="color: #01fe4d;" id="icons"></i>
                    </a>
                    <a href="https://www.instagram.com/univalle_bolivia/">
                        <i class="fa-brands fa-square-instagram fa-2xl" style="color: #d62985;" id="icons"></i>
                    </a>
                </div>
                <div class="col-md-6">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8152.484180339703!2d-68.302787604476!3d-16.63450475463702!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x915edbd7fa5321e9%3A0xb28dba774a17ba52!2sGrupo%20Industrial%20Vilycach!5e0!3m2!1ses-419!2sbo!4v1727801153352!5m2!1ses-419!2sbo" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </section>

    <button id="scrollBtn" class="btn btn-primary d-none" title="Subir al inicio">↑</button>

    <!-- Footer -->
    <footer class="py-4 bg-dark text-white">
        <div class="container text-center">
            &copy; 2023 - VILYCACH
        </div>
    </footer>

    <a href="#" class="scroll-to-top rounded">
        <i class="fas fa-chevron-up"></i>
    </a>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/3288cf83f6.js" crossorigin="anonymous"></script>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var scrollBtn = document.querySelector('.scroll-to-top');

            window.addEventListener('scroll', function () {
                if (window.scrollY > 100) {
                    scrollBtn.style.display = 'block';
                } else {
                    scrollBtn.style.display = 'none';
                }
            });

            scrollBtn.addEventListener('click', function (e) {
                e.preventDefault();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        });


    </script>

</body>
</html>
