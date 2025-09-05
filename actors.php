<?php
// Aquí se aplica **Dependency Injection**: se inyecta el repositorio $actorRepo (MySQLActor) en el flujo del controlador.
// Esto permite que la clase actors.php no dependa directamente de la implementación de la base de datos, 
// sino de una abstracción (ActorStrategy).
header("Content-Type: application/json");
include "db.php";
include "MySQLActor.php";

$actorRepo = new MySQLActor($conn);
$method = $_SERVER['REQUEST_METHOD'];
// También se aplica **Command Pattern de manera implícita** en el switch de métodos HTTP:
// GET, POST, PUT, DELETE actúan como "comandos" que ejecutan acciones concretas sobre el repositorio.

switch ($method) {
    case 'GET':
        $id = isset($_GET['id']) ? intval($_GET['id']) : null;
        echo json_encode($actorRepo->get($id));
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode($actorRepo->post($data));
        break;

    case 'PUT':
        if (!isset($_GET['id'])) {
            echo json_encode(["error" => "Se requiere ?id"]);
            exit;
        }
        $id = intval($_GET['id']);
        $data = json_decode(file_get_contents("php://input"), true);
        echo json_encode($actorRepo->put($id, $data));
        break;

    case 'DELETE':
        if (!isset($_GET['id'])) {
            echo json_encode(["error" => "Se requiere ?id"]);
            exit;
        }
        $id = intval($_GET['id']);
        echo json_encode($actorRepo->delete($id));
        break;

    default:
        echo json_encode(["error" => "Método no soportado"]);
}
?>
