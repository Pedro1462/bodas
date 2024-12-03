<?php

require_once "modelo/conexionBD.php";
require_once "modelo/consultasBD.php";

class inicioControlador
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new consultaEventos(baseDatos::conectarBD());
    }

    public function inicio()
    {
        require_once "vista/principal.php";
    }
}

class InicioControladorMenu
{
    private $eventosObtenidos;
    private $eventoId;

    public function __construct() {
        $this->eventosObtenidos = new NuestrosEventos(); 
        $this->eventoId = isset($_GET['id_paquete']) ? intval($_GET['id_paquete']) : 0;
    }

    public function mostrarEventos() {
        if ($this->eventoId > 0) {
            return $this->eventosObtenidos->obtenerEvento($this->eventoId);    
        } else {
            return "Seleccione un evento para ver más detalles.";
        }
    }
}

class inicioControladorLogin
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new consultaEventos(baseDatos::conectarBD());
    }

    public function inicio()
    {

        require_once "vista/login.php";
    }
}

class inicioControladorCotizacion
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new consultaEventos(baseDatos::conectarBD());
    }

    public function inicio()
    {

        require_once "vista/cotizacion.php";
    }
}

class inicioControladorPagos
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new consultaEventos(baseDatos::conectarBD());
    }

    public function inicio()
    {

        require_once "vista/pagos.php";
    }
}

class inicioControladorCargaLogin 
{
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

    public function inicio()
    {

        require_once "vista/validacionLogin.php";
    }
}

class inicioControladorUsuario 
{
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

    public function inicio()
    {

        require_once "vista/validacionRegistro.php";
    }

}

class inicioControladorAdmin
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new consultaEventos(baseDatos::conectarBD());
    }

    public function inicio()
    {
        require_once "vista/admin.php";
    }
}


?>
