<?php

class Usuario {
    private $nombre;
    private $apellido;
    private $correo;
    private $numeroTelefono;
    private $password;
    private $tipoUsuario;
    private $idUsuarios;
    
    private $conn;

    public function __construct($conn, $correoIngresado) {
        $this->conn = $conn;
        $this->cargarDatos($correoIngresado);
    }

    private function cargarDatos($correoIngresado) {
        try {
            // Consulta SQL para obtener los datos del usuario
            $sql = "SELECT u.id_usuarios, u.nombre, u.apellido, u.correo, u.numero_telefono, u.password, t.id_tipo_user
                    FROM usuarios u
                    LEFT JOIN tipo_user t ON t.id_tipo_user = u.id_tipo_user
                    WHERE u.correo = ?";
            
            // Preparar y ejecutar la consulta
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(1, $correoIngresado, PDO::PARAM_STR);
            $stmt->execute();

            // Obtener el resultado de la consulta
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verificar si se encontraron resultados
            if ($resultado) {
                // Asignar los valores obtenidos
                $this->idUsuarios = $resultado["id_usuarios"];
                $this->nombre = $resultado['nombre'];
                $this->apellido = $resultado['apellido'];
                $this->correo = $resultado['correo'];
                $this->numeroTelefono = $resultado['numero_telefono'];
                $this->password = $resultado['password'];
                $this->tipoUsuario = $resultado['id_tipo_user'];
            } else {
                throw new Exception("");
            }

        } catch (Exception $e) {
            throw new Exception("Error al cargar los datos del usuario: " . $e->getMessage());
        }
    }

    // Métodos para obtener la información
    public function getIdUsuarios() {
        return $this->idUsuarios;
    } 
    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function getNumeroTelefono() {
        return $this->numeroTelefono;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getTipoUsuario() {
        return $this->tipoUsuario;
    }
}


?>
