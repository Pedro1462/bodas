<?php
require_once '../controlador/inicio.controlador.php';

// Crear el controlador para los paquetes
$controlador = new PaqueteController();

// Obtener todos los eventos
$eventos = $controlador->obtenerEventos();

// Variables para manejar datos de paquetes y servicios
$paquetes = [];
$totalServicios = 0;
$mensaje = "";
$eventoSeleccionado = "";
$paqueteSeleccionado = "";

// Verificar la acción del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_evento']) && isset($_POST['ver_paquetes'])) {
        // Manejar selección de evento
        $evento_id = (int)$_POST['id_evento'];
        $eventoSeleccionado = $evento_id;
        $paquetes = $controlador->obtenerPaquetesPorEvento($evento_id);
        $totalServicios = $controlador->obtenerTotalServiciosPorEvento($evento_id);
    } elseif (isset($_POST['id_paquete']) && isset($_POST['id_usuarios'])) {
        // Manejar registro de pago a plazos
        $paqueteSeleccionado = $_POST['id_paquete'];
        $datos = [
            'id_usuarios' => $_POST['id_usuarios'],
            'id_paquete' => $paqueteSeleccionado,
            'id_evento' => $_POST['id_evento'], // Incluimos el evento seleccionado
            'monto_total' => $controlador->obtenerTotalServiciosPorEvento($paqueteSeleccionado), // Obtener monto total del paquete
            'fecha_pago' => $_POST['fecha_pago'],
            'plazos' => []
        ];

        if (!empty($_POST['numero_plazo']) && !empty($_POST['monto_plazo']) && !empty($_POST['fecha_plazo'])) {
            $datos['plazos'][] = [
                'numero_plazo' => $_POST['numero_plazo'],
                'monto_plazo' => $_POST['monto_plazo'],
                'fecha_pago' => $_POST['fecha_plazo'],
                'estado_pago' => 'pendiente'
            ];
        }

        $controladorPago = new ProcesarPagoPlazos($datos);
        $resultado = $controladorPago->procesar();
        $mensaje = $resultado;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos y Paquetes</title>
</head>

<body>
    <h1>Eventos y Paquetes</h1>

    <!-- Mostrar mensaje -->
    <?php if (!empty($mensaje)): ?>
        <p><strong><?= htmlspecialchars($mensaje); ?></strong></p>
    <?php endif; ?>

    <!-- Formulario para seleccionar evento -->
    <form method="POST">
        <h2>Registrar Pago a Plazos</h2>
        <label for="id_evento">Evento:</label>
        <select name="id_evento" id="id_evento" required>
            <option value="">-- Seleccionar --</option>
            <?php foreach ($eventos as $evento): ?>
                <option value="<?= $evento['id_eventos']; ?>"
                    <?= $eventoSeleccionado == $evento['id_eventos'] ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($evento['nombre_evento']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="ver_paquetes">Ver Paquetes</button>
    </form>
    <form method="POST">
    <label for="id_paquete">Paquete Seleccionado:</label>
        <select name="id_paquete" id="id_paquete" required>
            <option value="">-- Seleccionar --</option>
            <?php foreach ($paquetes as $paquete): ?>
                <option value="<?= $paquete['id_paquete']; ?>"
                    <?= $paqueteSeleccionado == $paquete['id_paquete'] ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($paquete['nombre_paquete']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="ver_paquetes">seleccionar</button>

    </form>
    <!-- Mostrar resultados de paquetes -->
  

    <!-- Formulario para registrar pago a plazos -->
    <form method="POST">
        <!-- ComboBox de Paquetes -->
       

        <input type="hidden" name="id_evento" value="<?= htmlspecialchars($eventoSeleccionado); ?>">

        <label for="id_usuarios">ID Usuario:</label>
        <input type="number" id="id_usuarios" name="id_usuarios" required><br><br>

        <!-- El monto total se calcula dinámicamente -->
        <p><strong>Monto Total del Paquete:</strong>
            <?= $paqueteSeleccionado ? $controlador->obtenerTotalServiciosPorEvento($paqueteSeleccionado) : 'N/A'; ?>
        </p>

        <label for="fecha_pago">Fecha de Pago:</label>
        <input type="date" id="fecha_pago" name="fecha_pago" required><br><br>

        <h3>Detalles de los Plazos</h3>
        <label for="numero_plazo">Número de Plazo:</label>
        <input type="number" id="numero_plazo" name="numero_plazo"><br><br>

        <label for="monto_plazo">Monto del Plazo:</label>
        <input type="number" step="0.01" id="monto_plazo" name="monto_plazo"><br><br>

        <label for="fecha_plazo">Fecha del Primer Plazo:</label>
        <input type="date" id="fecha_plazo" name="fecha_plazo"><br><br>

        <button type="submit">Registrar</button>
    </form>
</body>

</html>
 <!-- <?php if (!empty($paquetes)): ?>
        <h2>Paquetes del Evento Seleccionado</h2>
        <ul>
        <?php foreach ($paquetes as $paquete): ?>
                <li>
                    <?= htmlspecialchars($paquete['nombre_paquete']); ?>
                    (ID: <?= $paquete['id_paquete']; ?>) -
                    Monto: <?= $controlador->obtenerTotalServiciosPorEvento($paquete['id_paquete']); ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <p><strong>Total de Servicios:</strong> <?= $totalServicios; ?> </p>
    <?php endif; ?>-->