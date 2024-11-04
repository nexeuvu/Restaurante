<?php
require_once __DIR__ . '/funciones.php';
require_once __DIR__ . '/../config/database.php';

$productos = obtenerProductos();

if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    try {
        eliminarProducto($id);
        header('Location: index.php'); // Redirigir después de eliminar
        exit;
    } catch (Exception $e) {
        echo 'Error al eliminar: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Lista de Productos</h2>
        <a href="agregar_productos.php" class="btn btn-primary mb-3">Añadir Nuevo Producto</a>
        <a href="../index.php" class="btn btn-primary mb-3">Regresar</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Descripción</th>
                    <th>Categoría</th>
                    <th>Disponible</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($producto['precio']); ?></td>
                    <td><?php echo htmlspecialchars($producto['descripcion']); ?></td>
                    <td><?php echo htmlspecialchars($producto['categoria']); ?></td>                    
                    <td><?php echo $producto['disponible'] ? 'Sí' : 'No'; ?></td>
                    <td>
                        <?php if (!empty($producto['imagen'])): ?>
                            <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>" style="width: 100px; height: auto;">
                        <?php else: ?>
                            Sin imagen
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="editar_productos.php?id=<?php echo $producto['_id']; ?>" class="btn btn-primary">Editar</a>
                        <a href="?eliminar=<?php echo $producto['_id']; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>