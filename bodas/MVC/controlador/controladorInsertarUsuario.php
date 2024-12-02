<?php
require_once __DIR__ . "/../modelo/ingresarUsuario.php";

class UsuarioController {
    private $insercionUsuario;
    public $insertada;

    public function __construct() {
        $this->insercionUsuario = new UsuarioInsercion();
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $correo = $_POST['correo'];
            $numero_telefono = $_POST['numero_telefono'];
            $password = $_POST['password'];
            
           

            $this->insercionUsuario->insertarUsuario($nombre, $apellido, $correo, $numero_telefono, $password);
            $this->insertada = true;
        }else {
        $this->insertada = false;
        }
    }
}


