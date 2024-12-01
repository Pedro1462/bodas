<?php

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

class inicioControladorMenu
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new consultaEventos(baseDatos::conectarBD());
    }

    public function inicio()
    {

        require_once "vista/menuNuevo.php";
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
