<?php
require_once '../controlador/inicio.controlador.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = [
        'id_usuarios' => $_POST['id_usuarios'],
        'id_paquete' => $_POST['id_paquete'],
        'monto_total' => $_POST['monto_total'],
        'fecha_pago' => $_POST['fecha_pago']
    ];

    $controlador = new ProcesarPagoContado($datos);
    $resultado = $controlador->procesar();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario - Pago al Contado</title>
</head>
<body>
    <h1>Registro de Pago al Contado</h1>
    <form action="" method="POST">
        <label for="id_usuarios">ID del Usuario:</label>
        <input type="number" id="id_usuarios" name="id_usuarios" required><br><br>

        <label for="id_paquete">ID del Paquete:</label>
        <input type="number" id="id_paquete" name="id_paquete" required><br><br>

        <label for="monto_total">Monto Total:</label>
        <input type="number" step="0.01" id="monto_total" name="monto_total" required><br><br>

        <label for="fecha_pago">Fecha de Pago:</label>
        <input type="date" id="fecha_pago" name="fecha_pago" required><br><br>

        <input type="hidden" name="tipo_pago" value="contado">

        <button type="submit">Registrar Pago al Contado</button>
    </form>
</body>
</html>