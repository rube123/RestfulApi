<?php
$host = "localhost";
$user = "root";
$pass = "1234";
$db   = "sakila";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
