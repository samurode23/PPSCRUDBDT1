<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Minified version -->
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <title>Editar usuario</title>
</head>
<body>
    <h1>Editar usuario</h1>
    <?php if(isset($mensaje) && !empty($mensaje)): ?>
        <p><?php echo htmlspecialchars($mensaje); ?></p>
    <?php endif; ?>

    <?php if (!empty($usuario)): ?>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?id=' . urlencode($usuario['id']); ?>" method="post">
            <label for="nombre">Nombre: </label>
            <input id="nombre" type="text" placeholder="Nombre de usuario aquí" name="nombre"
                   value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>

            <label for="email">Email: </label>
            <input id="email" type="email" placeholder="Email de usuario aquí" name="email"
                   value="<?php echo htmlspecialchars($usuario['email']); ?>" required>

            <label for="rol">Rol: </label>
            <select id="rol" name="rol">
                <option value="admin" <?php echo ($usuario['rol']=='admin')?'selected':''; ?>>Administrador</option>
                <option value="guest" <?php echo ($usuario['rol']=='guest')?'selected':''; ?>>Invitado</option>
                <option value="editor" <?php echo ($usuario['rol']=='editor')?'selected':''; ?>>Editor</option>
            </select> 

            <input type="submit" value="Actualizar" name="actualizar">
        </form>
    <?php else: ?>
        <p>No existe el usuario solicitado.</p>
    <?php endif; ?>

    <p><a href="./index_user.php">Volver a listado usuarios</a></p>

</body>
</html>
