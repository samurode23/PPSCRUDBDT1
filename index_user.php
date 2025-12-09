<?php

include_once('./libraries/functions.php');

//Inicialización
boot();

//Lógica de negocio
$usuarios = getAllUsers();

//Lógica de presentación
include_once('./templates/index_users.tpl.php');
?>

