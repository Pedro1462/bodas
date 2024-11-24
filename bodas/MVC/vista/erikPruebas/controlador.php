<?php
require_once __DIR__ . '/conexionBD.php';
require_once __DIR__ . '/consultas.php';

class controlador {
    private $db;

    public function __construct() {
        $conexion = new BaseDeDatos();
        $this->db = $conexion->getConexion();
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
