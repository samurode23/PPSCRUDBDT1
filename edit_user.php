<?php

include_once('./libraries/functions.php');

//Inicialización
boot();

//Lógica de negocio
$mensaje = '';
$usuario = null;

//Obtenemos ID de la querystring
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id === false || $id === null) {
    //ID inválido, volvemos al listado
    header("Location: ./index_user.php");
    exit;
}

//Cargamos el usuario actual
$usuario = getUserById($id);

if (!$usuario) {
    $mensaje = 'El usuario no existe';
} else {

    //Si han enviado el formulario de actualización
    if (isset($_POST['actualizar'])) {
        $userData = filter_input_array(INPUT_POST, [
            'nombre' => FILTER_DEFAULT,
            'email'  => FILTER_VALIDATE_EMAIL,
            'rol'    => FILTER_DEFAULT
        ]);

        if (!empty($userData) && $userData['email']) {

            $ok = updateUser($id, $userData['nombre'], $userData['email'], $userData['rol']);

            if ($ok) {
                $mensaje = 'Usuario actualizado correctamente';
                //Volvemos a cargar datos actualizados desde BD
                $usuario = getUserById($id);
            } else {
                $mensaje = 'Error al actualizar el usuario';
            }
        } else {
            $mensaje = 'Datos no válidos (revisa el email)';
        }
    }
}

//Lógica de presentación
include_once('./templates/edit_user.tpl.php');
?>
