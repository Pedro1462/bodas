<?php

class baseDatos{

    const HOST = "localhost";
    const USER = "root";
    const PASSWORD = "";
    const DATABASE = "eventos";

    public static function conectarBD() {
        try {
            //asi se conecta utilizando PDO
            $conexion = new PDO("mysql:host=" . self::HOST . ";dbname=" . self::DATABASE, self::USER, self::PASSWORD);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            exit();
        }    
        
    }
}
class ControladorPago {
    private $tarjeta;

    public function __construct($dbConnection) {
        $this->tarjeta = new Tarjeta($dbConnection);
    }

    // Método para manejar el proceso de insertar una tarjeta
    public function procesarPago($datosFormulario) {
        $idUsuario = $datosFormulario['id_usuario']; // ID del usuario (debe venir del sistema)
        $nombre = $datosFormulario['nombre'];
        $numeroTarjeta = $datosFormulario['numero'];
        $fechaVencimiento = $datosFormulario['fecha_vencimiento'];
        $cvv = $datosFormulario['cvv'];

        // Formatear la fecha de vencimiento
        list($mes, $anio) = explode('/', $fechaVencimiento);
        $fechaVencimiento = "20$anio-$mes-01";

        // Llamar al método de la clase Tarjeta
        $resultado = $this->tarjeta->insertar($idUsuario, $nombre, $numeroTarjeta, $fechaVencimiento, $cvv);

        // Devolver el resultado
        if ($resultado) {
            return "Tarjeta registrada con éxito.";
        } else {
            return "Error al registrar la tarjeta.";
        }
    }
}


?>