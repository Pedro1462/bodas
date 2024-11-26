<?php
class BaseDeDatos {
    private $host = 'localhost';
    private $user = 'pizzas';
    private $password = '!emo.([wPTyxNTmO';
    private $database = 'eventos';
    private $conexion;

    public function __construct() {
        $this->conexion = new mysqli($this->host, $this->user, $this->password, $this->database);

        if ($this->conexion->connect_error) {
            throw new Exception("Error en la conexión: " . $this->conexion->connect_error);
        }
    }

    public function prepareQuery($sql) {
        $stmt = $this->conexion->prepare($sql);
        if (!$stmt) {
            throw new Exception("Error en la preparación de la consulta: " . $this->conexion->error);
        }
        return $stmt;
    }
    public function getConexion() {
        return $this->conexion;
    }

    public function cerrarConexion() {
        if ($this->conexion) {
            $this->conexion->close();
            $this->conexion = null;
        }
    }

    public function estaConectado() {
        return $this->conexion !== null;
    }

    public function __destruct() {
       
    }
}
?>