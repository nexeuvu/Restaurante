<?php
require_once __DIR__ . '/../config/database.php'; // Asegúrate de que esta línea esté presente

function agregarProducto($nombre, $precio, $descripcion, $categoria, $disponible, $imagen) {
    global $db;
    return $db->productos->insertOne([
        'nombre' => sanitizeInput($nombre),
        'precio' => (float)$precio,
        'descripcion' => sanitizeInput($descripcion),
        'categoria' => sanitizeInput($categoria),
        'disponible' => (bool)$disponible,
        'imagen' => sanitizeInput($imagen)
    ])->getInsertedId();
}

function obtenerProductos() {
    global $db;
    return $db->productos->find();
}

function agregarPedido($id_producto, $cantidad, $precio_unitario, $notas) {
    global $db;
    return $db->pedidos->insertOne([
        'id_producto' => sanitizeInput($id_producto),
        'cantidad' => (int)$cantidad,
        'precio_unitario' => (float)$precio_unitario,
        'notas' => sanitizeInput($notas),
        'fecha' => new MongoDB\BSON\UTCDateTime()
    ])->getInsertedId();
}

function obtenerPedidos() {
    global $db;
    return $db->pedidos->find();
}

function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}
?>