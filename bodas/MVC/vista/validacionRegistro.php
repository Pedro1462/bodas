<?php
require_once __DIR__ . '/../controlador/controladorInsertarUsuario.php';

$usuarioController = new UsuarioController();
$usuarioController->handleRequest();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/validacionLogin.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
<div class="loading-container">
    <?php if ($usuarioController->insertada): ?>
        <div class="loading-circle"></div>
        <h2 class="loading-text">¡Registro exitoso!</h2>
        <p class="loading-text">Redirigiendo a tu página...</p>
    <?php else: ?>
        <div class="loading-circle"></div>
        <h2 class="loading-text">Error al cargar los datos. Inténtalo nuevamente.</h2>
    <?php endif; ?>
</div>

<script>
    <?php if ($usuarioController->insertada): ?>
        setTimeout(function() {
            window.location.href = "http://localhost:3000/bodas/MVC/vista/principal.php";
        }, 5000);
    <?php else: ?>
        setTimeout(function() {
            window.location.href = "http://localhost:3000/bodas/MVC/vista/login.php";
        }, 5000);
    <?php endif; ?>
</script>
</body>
</html>