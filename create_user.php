<?php

include_once('./libraries/functions.php');

//Inicialización
boot();

//Lógica de negocio
$mensaje = '';

if (isset($_POST['crear'])) {
    //Recogemos datos del formulario
    $userData = filter_input_array(INPUT_POST, [
        'nombre' => FILTER_DEFAULT,
        'email'  => FILTER_VALIDATE_EMAIL,
        'rol'    => FILTER_DEFAULT
    ]);

    if (!empty($userData) && $userData['email']) {
        //Creamos usuario en la BD
        createUser($userData['nombre'], $userData['email'], $userData['rol']);
        $mensaje = 'Usuario creado correctamente';
    } else {
        $mensaje = 'Datos no válidos (revisa el email)';
    }
}

//Lógica de presentación
include_once('./templates/create_users.tpl.php');
?>
