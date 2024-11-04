<?php
require_once __DIR__ . '/funciones.php';
require_once __DIR__ . '/../config/database.php';

// Manejar la eliminación de un cliente
if (isset($_POST['eliminar'])) {
    $id = new MongoDB\BSON\ObjectId($_POST['id']);
    eliminarCliente($id);
    header('Location: index.php'); // Redirigir después de eliminar
    exit;
}

$clientes = obtenerClientes();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Lista de Clientes</h2>
        <a href="agregar_clientes.php" class="btn btn-primary mb-3">Añadir Nuevo Cliente</a>
        <a href="../index.php" class="btn btn-primary mb-3">Regresar</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Ciudad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cliente): ?>
                <tr>
                    <td><?php echo htmlspecialchars($cliente->nombre); ?></td>
                    <td><?php echo htmlspecialchars($cliente->correo); ?></td>
                    <td><?php echo htmlspecialchars($cliente->telefono); ?></td>
                    <td><?php echo htmlspecialchars($cliente->direccion); ?></td>
                    <td><?php echo htmlspecialchars($cliente->ciudad); ?></td>
                    <td>
                        <a href="editar_clientes.php?id=<?php echo $cliente->_id; ?>" class="btn btn-sm btn-warning">Editar</a>
                        <form action="" method="POST" style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo $cliente->_id; ?>">
                            <button type="submit" name="eliminar" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?');">Eliminar</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>