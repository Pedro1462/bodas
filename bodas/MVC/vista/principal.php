<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/bodas.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>El gran día</title>
</head>

<body>
    <div class="parent">

        <div class="div1">
            <p class="presentacion">Encuentra todo para tus eventos en un solo lugar</p>
        </div>

        <div class="div2">
            <div class="row">
                <h1 class="centrar">
                    <img src="../../img/logo1.png" class="logo" alt="logo1">
                    <a href="index.php"><strong>El gran día</strong></a>
                </h1>
            </div>

            <div class="col">
                <div class="btn-group">
                    <!--<button class="btn btn-personalizado" onclick="location.href='?c=menu';">Menú</button> -->
                    <button class="btn btn-personalizado" onclick="location.href='?c=cotizacion';">Cotización</button>
                </div>
            </div>

            <div class="col">
                <div class="btn-group">
                    <button class="btn btn-personalizado" onclick="location.href='?c=login';">
                        <img src="../../img/img4.png" class="logo" alt="img4"> Iniciar Sesión
                    </button>
                </div>
            </div>
        </div>

        <div class="div3">
            <?php
            require_once 'modelo/consultasBD.php';
            $controlador = new imagenesParaElCarrusel();
            $paquetes = $controlador->obtenerPaquetesSinUsuario();
            ?>

            <div id="carouselExampleCaptions" class="carousel slide">
                <div class="carousel-indicators">
                    <?php foreach ($paquetes as $index => $paquete): ?>
                        <button type="button" data-bs-target="#carouselExampleCaptions"
                            data-bs-slide-to="<?= $index ?>"
                            class="<?= $index === 0 ? 'active' : '' ?>"
                            aria-current="<?= $index === 0 ? 'true' : 'false' ?>"
                            aria-label="Slide <?= $index + 1 ?>"></button>
                    <?php endforeach; ?>
                </div>

                <div class="carousel-inner">
                    <?php foreach ($paquetes as $index => $paquete): ?>
                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                    <!-- erik-->
                            <a onclick="location.href='?c=menu&?a=mostrarevento&id_paquete=<?= $paquete['id_paquete'] ?>';">
                                <img src="<?= $paquete['ruta_imagen'] ?>" class="d-block w-100" alt="Imagen <?= $paquete['id_paquete'] ?>">
                            </a>
                            <div class="carousel-caption d-none d-md-block">
                                <h3><?= $paquete['titulo'] ?? 'Evento Especial' ?></h3>
                                <p><?= $paquete['descripcion'] ?? 'Disfruta de un momento único con nuestro paquete exclusivo.' ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>


                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="div5">
            <div class="gallery-container">
                <h3>Galería de Eventos</h3>
                <div class="gallery-images">
                    <img src="../../img/boda2.jpg" class="galeria" alt="boda2">
                    <img src="../../img/boda3.jpg" class="galeria" alt="boda3">
                    <img src="../../img/banquete2.jpg" class="galeria" alt="banquete2">
                    <img src="../../img/banquete3.jpg" class="galeria" alt="banquete3">
                    <img src="../../img/quince2.jpg" class="galeria" alt="quince2">
                    <img src="../../img/quince3.jpg" class="galeria" alt="quince3">
                </div>
            </div>

        </div>

        <div class="div6">
            <h2>¡Planea tu evento con nosotros!</h2>
            <p>
                Disfrutar del proceso para planear el evento de ensueño sí es posible.
                Encuentra todo lo que necesites para tu evento de forma rápida y sencilla.
                En bodasesor nos comprometemos a que encuentres todo lo que necesitas en cuestión de minutos.
                Conoce a nuestra gran cantidad de servicios premium que estarán para ti en el momento que más necesites.
            </p>
        </div>

        <div class="div7">
            <h2>Eventos: El gran día</h2>
            <h2>Contáctanos</h2>
            <p><strong>Dirección:</strong> Paseos de Maule, Av Huayacán Supermanzana 313 Manzana 243 lote 05, 77533, Cancún, Quintana Roo</p>
            <p><strong>Teléfono:</strong> +529981483778</p>
            <p><strong>Email:</strong> eventos@grandia.com</p>
            <p><strong>Horario:</strong> Lunes a Viernes de 8 a.m - 11 p.m</p>
        </div>

        <div class="div4">
            <footer>
                <a href="https://web.whatsapp.com/"><img src="../../img/reds1.png" class="logo" alt="reds1"></a>
                <a href="https://www.facebook.com/"><img src="../../img/reds2.png" class="logo" alt="reds2"></a>
                <a href="https://www.tiktok.com/es/"><img src="../../img/reds3.png" class="logo" alt="reds3"></a>
                <a href="https://x.com/?lang=es"><img src="../../img/reds4.png" class="logo" alt="reds4"></a>
                <a href="https://www.youtube.com/"><img src="../../img/reds5.png" class="logo" alt="reds5"></a>
                <a href="https://www.instagram.com/"><img src="../../img/reds6.png" class="logo" alt="reds6"></a>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>