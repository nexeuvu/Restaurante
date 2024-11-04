<?php
require_once __DIR__ . '/../config/database.php';

function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}

function agregarProducto($nombre, $precio, $descripcion, $categoria, $disponible, $imagen) {
    global $db;
    return $db->productos->insertOne([
        'nombre' => sanitizeInput($nombre),
        'precio' => (float)$precio,
        'descripcion' => sanitizeInput($descripcion),
        'categoria' => sanitizeInput($categoria),
        'disponible' => (bool)$disponible,
        'imagen' => sanitizeInput($imagen)
    ]);
}

function obtenerProductos() {
    global $db;
    return $db->productos->find();
}

function editarProducto($id, $nombre, $precio, $descripcion, $categoria, $disponible, $imagen) {
    global $db;
    return $db->productos->updateOne(['_id' => new MongoDB\BSON\ObjectId($id)], ['$set' => [
        'nombre' => sanitizeInput($nombre),
        'precio' => (float)$precio,
        'descripcion' => sanitizeInput($descripcion),
        'categoria' => sanitizeInput($categoria),
        'disponible' => (bool)$disponible,
        'imagen' => sanitizeInput($imagen)
    ]]);
}

function eliminarProducto($id) {
    global $db;
    return $db->productos->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
}
?>