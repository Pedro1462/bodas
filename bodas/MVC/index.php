<?php

$controlador = isset($_GET['c']) ? $_GET['c'] : 'inicio';
$accion = isset($_GET['a']) ? $_GET['a'] : 'inicio';

require_once "controlador/inicio.controlador.php";


switch ($controlador) {
    case 'inicio':
        $controladorObjeto = new inicioControlador();
        ejecutarAccion($controladorObjeto, $accion, $_POST);
        break;

    case 'menu':
        $controladorObjeto = new inicioControladorMenu();
        ejecutarAccion($controladorObjeto, $accion, $_POST);
        break;

    case 'login':
        $controladorObjeto = new inicioControladorLogin();
        ejecutarAccion($controladorObjeto, $accion, $_POST);
        break;

    case 'cotizacion':
        $controladorObjeto = new inicioControladorCotizacion();
        ejecutarAccion($controladorObjeto, $accion, $_POST);
        break;

    case 'pagos':
        $controladorObjeto = new inicioControladorPagos();
        ejecutarAccion($controladorObjeto, $accion, $_POST);
        break;

    case 'cargalogin':
        $controladorObjeto = new  inicioControladorCargaLogin();
        ejecutarAccion($controladorObjeto, $accion, $_POST);
        break;

    case 'cargaRegistro':
        $controladorObjeto = new inicioControladorUsuario();
        ejecutarAccion($controladorObjeto, $accion, $_POST);
        break;

    case 'admin':
        $controladorObjeto = new inicioControladorAdmin();
        ejecutarAccion($controladorObjeto, $accion, $_POST);
        break;

    case 'principalCliente':
        $controladorObjeto = new inicioControladorPrincipalCliente();
        ejecutarAccion($controladorObjeto, $accion, $_POST);
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

function llamarAccionParametroId($controladorObjeto, $accion, $parametro = null)
{
    if (method_exists($controladorObjeto, $accion)) {
        call_user_func(array($controladorObjeto, $accion), $parametro);
    } else {
        echo "La acción '$accion' no existe en el controlador.";
    }
}
