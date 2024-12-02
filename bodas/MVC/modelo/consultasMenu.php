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
        $sql = "SELECT nombre_evento FROM eventos WHERE id_eventos = :id_eventos";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id_eventos', $this->evento_id, PDO::PARAM_INT); // Asociar el valor usando PDO
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['nombre_evento'] ?? 'Nombre del evento no encontrado';
    }
    

    private function obtenerPaquetes() {
        $sql = "SELECT id_paquete, nombre_paquete, ruta_imagen, descripcion, ruta_imagen1, ruta_imagen2, ruta_imagen3 
                FROM paquetes WHERE id_eventos = :id_eventos";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id_eventos', $this->evento_id, PDO::PARAM_INT);
        $stmt->execute();
        $paquetes = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $servicios = $this->obtenerServicios($row['id_paquete']);
            $total_paquete = $this->calcularTotalServicios($servicios);
            $paquetes[] = [
                'id_paquete' => $row['id_paquete'],
                'nombre_paquete' => $row['nombre_paquete'],
                'ruta_imagen' => $row['ruta_imagen'],
                'descripcion' => $row['descripcion'],
                'servicios' => $servicios,
                'ruta_imagen1' => $row['ruta_imagen1'],
                'ruta_imagen2' => $row['ruta_imagen2'],
                'ruta_imagen3' => $row['ruta_imagen3'],
                'total_paquete' => $total_paquete,
            ];
            $this->total_evento += $total_paquete;
        }
        return $paquetes;
    }
    

    private function obtenerServicios($paquete_id) {
        $sql = "SELECT s.id_servicio, s.nombre_servicio, s.descripcion, s.precio_servicio 
                FROM servicios s
                INNER JOIN paquete_servicio ps ON s.id_servicio = ps.id_servicio
                WHERE ps.id_paquete = :id_paquete";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id_paquete', $paquete_id, PDO::PARAM_INT);
        $stmt->execute();
        $servicios = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $servicios[] = $row;
        }
        return $servicios;
    }
    

    private function obtenerUsuarios() {
        $sql = "SELECT u.id_usuarios, u.nombre, u.apellido, u.correo 
                FROM usuarios u
                INNER JOIN paquetes p ON u.id_usuarios = p.id_usuarios
                WHERE p.id_eventos = :id_eventos";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id_eventos', $this->evento_id, PDO::PARAM_INT);
        $stmt->execute();
        $usuarios = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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
