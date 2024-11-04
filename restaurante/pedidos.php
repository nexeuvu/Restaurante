<?php
require_once __DIR__ . '/includes/functions.php';

$pedidoRealizado = null; // Variable para almacenar el pedido realizado

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];
    $precio_unitario = $_POST['precio_unitario'];
    $notas = $_POST['notas'];

    // Agregar el pedido y obtener el ID
    $id = agregarPedido($id_producto, $cantidad, $precio_unitario, $notas);
    
    if ($id) {
        // Si el pedido se creó con éxito, almacenar los detalles del pedido
        $pedidoRealizado = [
            'id_producto' => $id_producto,
            'cantidad' => $cantidad,
            'precio_unitario' => $precio_unitario,
            'notas' => $notas,
            'id' => $id
        ];
    } else {
        $error = "No se pudo crear el pedido.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Pedido</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>
    <h1>Agregar Pedido</h1>
    
    <?php if ($pedidoRealizado): ?>
        <h2>Pedido realizado con éxito</h2>
        <p><strong>ID Producto:</strong> <?php echo htmlspecialchars($pedidoRealizado['id_producto']); ?></p>
        <p><strong>Cantidad:</strong> <?php echo htmlspecialchars($pedidoRealizado['cantidad']); ?></p>
        <p><strong>Precio Unitario:</strong> <?php echo htmlspecialchars($pedidoRealizado['precio_unitario']); ?></p>
        <p><strong>Notas:</strong> <?php echo htmlspecialchars($pedidoRealizado['notas']); ?></p>
        <p><strong>ID del Pedido:</strong> <?php echo htmlspecialchars($pedidoRealizado['id']); ?></p>
        <a href="index.php" class="button">Volver</a>
    <?php else: ?>
        <form method="POST">
            <label>ID Producto: <input type="text" name="id_producto" required></label>
            <label>Cantidad: <input type="number" name="cantidad" required></label>
            <label>Precio Unitario: <input type="number" step="0.01" name="precio_unitario" required></label>
            <label>Notas: <textarea name="notas" required></textarea></label>
            <input type="submit" value="Crear Pedido">
            <a href="index.php" class="button">Volver</a>
        </form>
    <?php endif; ?>
</body>
</html>