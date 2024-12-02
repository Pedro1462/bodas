<?php
require_once __DIR__ . '/conexionBD.php';

class UsuarioInsercion {
    private $db;

    public function __construct() {
        $conn = new baseDatos();  
        $this->db = $conn->conectarBD(); 
    }

    public function insertarUsuario($nombre, $apellido, $correo, $numero_telefono, $password): void {
        try {
            // Iniciar la transacción
            $this->db->beginTransaction();

            
            $this->insertarEnUsuario($nombre, $apellido, $correo, $numero_telefono, $password);

            // Confirmar la transacción
            $this->db->commit();
            echo "";
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            $this->db->rollback();
            echo "Error: " . $e->getMessage();
        }
    }

    private function insertarEnUsuario($nombre, $apellido, $correo, $numero_telefono, $password): void {
        $query = "INSERT INTO usuarios (nombre, apellido, correo, numero_telefono, password, id_tipo_user) VALUES (?, ?, ?, ?, ?, 1)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$nombre, $apellido, $correo, $numero_telefono, $password]);
    }
}
?>