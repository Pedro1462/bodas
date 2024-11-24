<?php
class Evento {
    private $conn;
    private $evento_id;
    public $nombre_evento;
    public $paquetes = [];
    public $usuarios = [];
    public $total_evento = 0; // Total general de todos los paquetes

    public function __construct($conn, $evento_id) {
        $this->conn = $conn;
        $this->evento_id = $evento_id;
        $this->cargarDatos();
    }

    private function cargarDatos() {
        try {
            $this->nombre_evento = $this->obtenerNombreEvento();
            $this->paquetes = $this->obtenerPaquetes();
            $this->usuarios = $this->obtenerUsuarios();
        } catch (Exception $e) {
            throw new Exception("Error al cargar los datos del evento: " . $e->getMessage());
        }
    }

    private function obtenerNombreEvento() {
        $sql = "SELECT nombre_evento FROM eventos WHERE id_eventos = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $this->evento_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()['nombre_evento'] ?? 'Nombre del evento no encontrado';
    }

    private function obtenerPaquetes() {
        $sql = "SELECT id_paquete, nombre_paquete, ruta_imagen, descripcion 
                FROM paquetes WHERE id_eventos = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $this->evento_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $paquetes = [];
        while ($row = $result->fetch_assoc()) {
            $servicios = $this->obtenerServicios($row['id_paquete']);
            $total_paquete = $this->calcularTotalServicios($servicios); // Sumar precios de servicios del paquete
            $paquetes[] = [
                'id_paquete' => $row['id_paquete'],
                'nombre_paquete' => $row['nombre_paquete'],
                'ruta_imagen' => $row['ruta_imagen'],
                'descripcion' => $row['descripcion'], // Añadido campo descripción
                'servicios' => $servicios,
                'total_paquete' => $total_paquete,
            ];
            $this->total_evento += $total_paquete; // Acumular total general
        }
        return $paquetes;
    }

    private function obtenerServicios($paquete_id) {
        $sql = "SELECT s.id_servicio, s.nombre_servicio, s.descripcion, s.precio_servicio 
                FROM servicios s
                INNER JOIN paquete_servicio ps ON s.id_servicio = ps.id_servicio
                WHERE ps.id_paquete = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $paquete_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $servicios = [];
        while ($row = $result->fetch_assoc()) {
            $servicios[] = $row;
        }
        return $servicios;
    }

    private function obtenerUsuarios() {
        $sql = "SELECT u.id_usuarios, u.nombre, u.apellido, u.correo 
                FROM usuarios u
                INNER JOIN paquetes p ON u.id_usuarios = p.id_usuarios
                WHERE p.id_eventos = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $this->evento_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuarios = [];
        while ($row = $result->fetch_assoc()) {
            $usuarios[] = $row;
        }
        return $usuarios;
    }

    private function calcularTotalServicios($servicios) {
        $total = 0;
        foreach ($servicios as $servicio) {
            $total += $servicio['precio_servicio'];
        }
        return $total;
    }
}

?>
