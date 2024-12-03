<?php
require_once "conexionBD.php";

class consultaEventos
{
    private $eventoConexion;
    public function __construct($conexion)
    {
     $this->eventoConexion = $conexion;   
    }

    public function consultaImagen()
    {
        
    }

}

class Usuario 
{
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

class ValidadorUsuario
{
    private $db;

    public function __construct()
    {
        $conn = new baseDatos();
        $this->db = $conn->conectarBD();
    }

    public function validarCredenciales($correoIngresado, $contraIngresada)
    {
        try {
            $usuario = new Usuario($this->db, $correoIngresado);
            $contraseñaAlmacenada = $usuario->getPassword();
           
    
            if (($usuario->getCorreo() == $correoIngresado) && ($usuario->getPassword() == $contraIngresada)) {
                return [
                    "status" => true,
                    "nombreUsuario" => $usuario->getNombre(),
                    "correo" => $usuario->getCorreo(),
                    "tipoUsuario" => $usuario->getTipoUsuario(),
                    
                ];
            } else {
                throw new Exception("Contraseña incorrecta.");
            }
        } catch (Exception $e) {
            return [
                "status" => false,
                "error" => $e->getMessage()
            ];
        }
    }
    
}

class UsuarioInsercion 
{
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

class Evento 
{
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
class NuestrosEventos {
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
    class imagenesParaElCarrusel{
        private $db;

        public function __construct() {
            $conexion = new baseDatos();
            $this->db = $conexion->conectarBD();
        }
    
        public function obtenerPaquetesSinUsuario()
    {
        $query = "SELECT id_paquete, ruta_imagen FROM paquetes WHERE id_usuarios IS NULL";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error al obtener paquetes: " . $e->getMessage();
            return [];
        }
    }
}
    

?>