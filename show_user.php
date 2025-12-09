<?php

include_once('./libraries/functions.php');

//Inicialización
boot();

//Lógica de negocio
$usuario = null;

//Obtenemos ID de la querystring
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id !== false && $id !== null) {
    $usuario = getUserById($id);
}

//Lógica de presentación
include_once('./templates/show_user.tpl.php');
?>
