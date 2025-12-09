<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Minified version -->
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
    <title>Lista de usuarios</title>
</head>
<body>
    <h1>Usuarios en sistema</h1>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
        <?php if (!empty($usuarios)): ?>
            <?php foreach($usuarios as  $usuario): ?>  
            <tr>
                <td><?php echo htmlspecialchars($usuario['nombre']); ?></td>
                <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                <td><?php echo htmlspecialchars(ucfirst($usuario['rol'])); ?></td>
                <td>
                    <a href="show_user.php?id=<?php echo urlencode($usuario['id']); ?>">Ver</a> |
                    <a href="edit_user.php?id=<?php echo urlencode($usuario['id']); ?>">Editar</a>
                </td>
            </tr>
            <?php endforeach; ?>   
        <?php else: ?>
            <tr>
                <td colspan="4">No hay usuarios en el sistema.</td>
            </tr>
        <?php endif; ?>
    </table>
    <p><a href="./create_user.php">NUEVO USUARIO</a></p>

</body>
</html>
