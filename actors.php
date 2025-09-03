<?php
header("Content-Type: application/json");
include "db.php";
include "MySQLActor.php";

$actorRepo = new MySQLActor($conn);
$method = $_SERVER['REQUEST_METHOD'];

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
