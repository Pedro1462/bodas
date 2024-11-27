<?php
require_once './erikpruebas/controlador.php';
$controlador = new Controlador();
$evento = $controlador->obtenerEvento(1);

if (!$evento) {
    die("No se pudo obtener la información del evento.");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/menu.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo htmlspecialchars($evento->nombre_evento); ?></title>
</head>

<body>
    <div class="container">
        <header class="header">
            <h1>Pedro bodas y más</h1>
            <nav class="nav">
                <a href="#">Ciudad</a>
                <a href="#">Banquete & Catering</a>
                <a href="#">Mobiliario</a>
                <a href="#">Servicios</a>
                <a href="#">Tipo de Evento</a>
            </nav>
        </header>
        <main class="content">
            <div class="image-gallery">
                <?php if (!empty($evento->paquetes[0]['ruta_imagen'])): ?>
                    <img class="main-image" src="<?php echo htmlspecialchars($evento->paquetes[0]['ruta_imagen']); ?>" alt="Imagen principal del paquete">
                <?php else: ?>
                    <img class="main-image" src="../../img/default.jpg" alt="Imagen no disponible">
                <?php endif; ?>

                <div class="thumbnail-gallery">
                    <?php foreach ($evento->paquetes as $paquete): ?>
                        <img src="<?php echo htmlspecialchars($paquete['ruta_imagen1']); ?>" alt="Miniatura del paquete">
                    <?php endforeach; ?>
                    <?php foreach ($evento->paquetes as $paquete): ?>
                        <img src="<?php echo htmlspecialchars($paquete['ruta_imagen2']); ?>" alt="Miniatura del paquete">
                    <?php endforeach; ?>
                    <?php foreach ($evento->paquetes as $paquete): ?>
                        <img src="<?php echo htmlspecialchars($paquete['ruta_imagen3']); ?>" alt="Miniatura del paquete">
                    <?php endforeach; ?>
                </div>
                
            </div>

            <div class="description">
                <h2><?php echo htmlspecialchars($evento->nombre_evento); ?></h2>
                <p>
                    <strong><?php echo htmlspecialchars($evento->nombre_evento); ?></strong> es un evento con los siguientes paquetes y servicios:
                </p>
                <ul class="tags">
                    <?php foreach ($evento->paquetes as $paquete): ?>
                        <li>
                            <strong><?php echo htmlspecialchars($paquete['nombre_paquete']); ?>:</strong>
                            <p><?php echo htmlspecialchars($paquete['descripcion']); ?></p> <!-- Descripción añadida -->
                            <span>Total del paquete: <?php echo '$' . number_format($paquete['total_paquete'], 2); ?></span>
                            <ul>
                                <?php foreach ($paquete['servicios'] as $servicio): ?>
                                    <li><?php echo htmlspecialchars($servicio['nombre_servicio']); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <div class="buttons">
                    <button class="btn primary">Cotizar Gratis</button>
                    <button class="btn secondary">Mándanos un WhatsApp</button>
                </div>
            </div>
        </main>
        <footer class="footer">
            <div>Entregas y servicios</div>
            <div>Te cuidamos</div>
        </footer>
    </div>
</body>

</html>
