<?php
require_once "conexionBD.php";

class consultaEventos{
    private $eventoConexion;
    public function __construct($conexion)
    {
     $this->eventoConexion = $conexion;   
    }

    public function consultaImagen()
    {
        
    }

}

?>