<?php
// También se aplica el **Repository Pattern**: MySQLActor funciona como un repositorio 
// que abstrae las operaciones CRUD sobre la tabla actor, separando la lógica de acceso a datos
// del resto de la aplicación.
header("Content-Type: application/json");

$request = trim($_SERVER['REQUEST_URI'], "/");
$method  = $_SERVER['REQUEST_METHOD'];

if (strpos($request, "sakila-php/actors") !== false) {
    require "controllers/actors.php";
} else {
    echo json_encode(["error" => "Ruta no encontrada", "debug" => $request]);
}
