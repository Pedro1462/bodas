<?php

require_once "modelo/consultasBD.php";

class inicioControlador{
   /* private $modelo;

    public function __construct()
    {
        $this -> modelo = new consultaEventos(baseDatos::conectarBD());
    }*/

    public function inicio(){
        require_once "vista/capas/encabezado.php";
        require_once "vista/principal.php";
        require_once "vista/capas/pie.php";
    }


}

?>