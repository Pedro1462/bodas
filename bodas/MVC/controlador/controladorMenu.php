<?php
require_once __DIR__ . '/../modelo/conexionBD.php';
require_once __DIR__ . '/../modelo/consultasMenu.php';

class controlador {
    private $db;

    public function __construct() {
        $conexion = new baseDatos();
        $this->db = $conexion->conectarBD();
    }

    public function obtenerEvento($evento_id) {
        try {
            $evento = new Evento($this->db, $evento_id);
            if (empty($evento->nombre_evento)) {
                throw new Exception("Evento no encontrado.");
            }
            return $evento;
        } catch (Exception $e) {
            error_log("Error al obtener evento: " . $e->getMessage());
            return null;
        }
    }
}
