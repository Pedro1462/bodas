<?php

require_once "modelo/consultasBD.php";

class inicioControlador{
   /* private $modelo;

    public function __construct()
    {
        $this -> modelo = new consultaEventos(baseDatos::conectarBD());
    }*/

    public function inicio(){

        require_once "vista/principal.php";
      
    }


}

class inicioControladorErik{
    /* private $modelo;
 
     public function __construct()
     {
         $this -> modelo = new consultaEventos(baseDatos::conectarBD());
     }*/
 
     public function inicio(){
         
         require_once "vista/menu.php";
       
        
     }
 
 
 }

?>