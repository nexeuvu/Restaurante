<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php'; // Agregar esta línea

function obtenerClientes() {
    global $db;
    return $db->clientes->find([], ['sort' => ['nombre' => 1]]);
}

function agregarCliente($nombre, $correo, $telefono, $direccion, $ciudad) {
    global $db;
    return $db->clientes->insertOne([
        'nombre' => sanitizeInput($nombre),
        'correo' => sanitizeInput($correo),
        'telefono' => sanitizeInput($telefono),
        'direccion' => sanitizeInput($direccion),
        'ciudad' => sanitizeInput($ciudad),
        'fecha_registro' => date('Y-m-d')
    ]);
}

function editarCliente($id, $nombre, $correo, $telefono, $direccion, $ciudad) {
    global $db;
    return $db->clientes->updateOne(['_id' => new MongoDB\BSON\ObjectId($id)], ['$set' => [
        'nombre' => sanitizeInput($nombre),
        'correo' => sanitizeInput($correo),
        'telefono' => sanitizeInput($telefono),
        'direccion' => sanitizeInput($direccion),
        'ciudad' => sanitizeInput($ciudad)
    ]]);
}

function eliminarCliente($id) {
    global $db;
    return $db->clientes->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
}
?>