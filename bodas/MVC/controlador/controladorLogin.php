<?php
require_once __DIR__ . '/../modelo/validarLogin.php';

class ControladorLogin {
    private $correo;
    private $password;
    private $validarUsuario;

    private $nombreUsuario;
    private $idUsuario;
    private $tipoUsuario;
    private $status;

    public function __construct() {
        $this->correo = $_POST['correo'] ?? null;
        $this->password = $_POST['password'] ?? null;
        $this->validarUsuario = new ValidadorUsuario();
    }

    public function validarUser() {
        $resultado = $this->validarUsuario->validarCredenciales($this->correo, $this->password);

        if (isset($resultado['status']) && $resultado['status']) {
            $this->nombreUsuario = $resultado['nombreUsuario'] ?? null;
            $this->idUsuario = $resultado['idUsuario'] ?? null;
            $this->tipoUsuario = $resultado['tipoUsuario'] ?? null;
            $this->status = $resultado['status'];
        } else {
            echo htmlspecialchars("Usuario no encontrado");
        }
    }

    public function getNombreUsuario() {
        return $this->nombreUsuario;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getTipoUsuario() {
        return $this->tipoUsuario;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function getStatus() {
        return $this->status;
    }
}
?>