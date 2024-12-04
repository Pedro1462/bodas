<?php

require_once 'modelo/consultasBD.php';
require_once 'datosUsuario.php';

// Crea una instancia del controlador
$controladorTarjeta = new ControladorTarjeta();
echo $id;
// Verifica si los datos se enviaron correctamente
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoge los datos enviados
    $idUsuario = $control->getIdUsuario(); // Suponiendo que obtienes el ID del usuario desde la sesión
    $nombreTitular = $_POST['nombreTitular'] ?? '';
    $numeroTarjeta = $_POST['numeroTarjeta'] ?? '';
    $fechaVencimiento = $_POST['fechaVencimiento'] ?? '';
    $cvv = $_POST['cvv'] ?? '';

    // Prepara los datos en un arreglo asociativo
    $datosFormulario = [
        'idUsuario' => $idUsuario,
        'nombreTitular' => $nombreTitular,
        'numeroTarjeta' => $numeroTarjeta,
        'fechaVencimiento' => $fechaVencimiento,
        'cvv' => $cvv,
    ];

    // Llama al controlador para procesar el formulario
    $resultado = $controladorTarjeta->procesarFormulario($datosFormulario);

    // Muestra el resultado al usuario
    echo "<p>$resultado</p>";
}
?>
