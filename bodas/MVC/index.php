<?php

$controlador = isset($_GET['c'])?$_GET['c']:'inicio';
$accion = isset($_GET['a'])?$_GET['a']:'inicio';

require_once "controlador/inicio.controlador.php";

switch($controlador){
    case 'inicio': 
        $controladorObjeto=new inicioControlador();
        ejecutarAccion($controladorObjeto,$accion, $_POST);
        break;
    
    case 'erik':
        $controladorObjeto=new inicioControladorErik();
        ejecutarAccion($controladorObjeto,$accion, $_POST);
        break;

     case 'login':
        $controladorObjeto=new inicioControladorlogin();
        ejecutarAccion($controladorObjeto,$accion, $_POST);
        break;

}

function ejecutarAccion($controladorObjeto, $accion, $parametros = [])
{
    if (method_exists($controladorObjeto, $accion)) {
        call_user_func(array($controladorObjeto, $accion), $parametros);
    } else {
        echo "La acción '$accion' no existe en el controlador.";
    }
}


?>