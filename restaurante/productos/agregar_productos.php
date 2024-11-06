<?php
require_once __DIR__ . '/funciones.php';
require_once __DIR__ . '/../config/database.php';

$mensaje = '';

$categorias = [
    'Entradas',
    'Sopas y Cremas',
    'Ceviches y Mariscos',
    'Platos de Fondo (Platos Principales)',
    'Parrillas y Carnes',
    'Pastas y Arroces',
    'Vegetarianos y Veganos',
    'Postres',
    'Bebidas y Refrescos'
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];
    $disponible = isset($_POST['disponible']) ? true : false;
    $imagen = $_POST['imagen'];

    if (empty($nombre) || empty($precio) || empty($categoria)) {
        $mensaje = 'Por favor, completa los campos obligatorios.';
    } else {
        try {
            agregarProducto($nombre, $precio, $descripcion, $categoria, $disponible, $imagen);
            header('Location: index.php');
            exit;
        } catch (Exception $e) {
            $mensaje = 'Error: ' . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Producto</title>
    <link rel="stylesheet" href="../public/css/styles.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Nuevo Producto</h2>

        <?php if ($mensaje): ?>
            <div class="alert alert-danger"><?php echo $mensaje; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre *</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>

            <div class="mb-3">
                <label for="precio" class="form-label">Precio *</label>
                <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
            </div>

            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría *</label>
                <select class="form-select" id="categoria" name="categoria" required>
                    <option value="">Selecciona una categoría</option>
                    <?php foreach ($categorias as $cat): ?>
                        <option value="<?php echo htmlspecialchars($cat); ?>"><?php echo htmlspecialchars($cat); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="disponible" class="form-label">Disponible</label>
                <input type="checkbox" id="disponible" name="disponible">
            </div>

            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen *</label>
                <input type="text" class="form-control" id="imagen" name="imagen" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>