<?php

require_once __DIR__ . '/../vendor/autoload.php';

use MongoDB\Client;

try {
    $client = new Client(
        "mongodb+srv://nexeu:TceZls66z3KGr2N1@restaurant.1dnrf.mongodb.net/?retryWrites=true&w=majority&appName=restaurant"
    );

    $db = $client->restaurante;

} catch (Exception $e) {
    die("Error de conexión: " . $e->getMessage());
}