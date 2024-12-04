<?php
$control = new inicioControladorCargaLogin();
$control->validarUser();
$id = $control->getIdUsuario();
?>