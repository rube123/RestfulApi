<?php
header("Content-Type: application/json");

$request = trim($_SERVER['REQUEST_URI'], "/");
$method  = $_SERVER['REQUEST_METHOD'];

if (strpos($request, "sakila-php/actors") !== false) {
    require "actors.php";
} else {
    echo json_encode(["error" => "Ruta no encontrada", "debug" => $request]);
}
