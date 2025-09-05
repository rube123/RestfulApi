<?php
include "db.php";
include "ActorStrategy.php";
// Esta clase implementa **Strategy Pattern** porque sigue la interfaz ActorStrategy.
// Podrías cambiar MySQLActor por otra clase que implemente la misma interfaz sin modificar el resto del código.

class MySQLActor implements ActorStrategy {
    private $conn;
// Aquí se aplica **Dependency Injection** al pasar $connection en el constructor.
    public function __construct($connection) {
        $this->conn = $connection;
    }
// También se aplica el **Repository Pattern**: MySQLActor funciona como un repositorio 
    // que abstrae las operaciones CRUD sobre la tabla actor, separando la lógica de acceso a datos
    // del resto de la aplicación.
    public function get($id = null) {
        if ($id) {
            $sql = "SELECT * FROM actor WHERE actor_id = $id";
        } else {
            $sql = "SELECT * FROM actor LIMIT 50";
        }
        $result = $this->conn->query($sql);
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function post($data) {
        $first_name = $this->conn->real_escape_string($data['first_name']);
        $last_name  = $this->conn->real_escape_string($data['last_name']);
        $sql = "INSERT INTO actor (first_name, last_name, last_update) 
                VALUES ('$first_name', '$last_name', NOW())";
        if ($this->conn->query($sql)) {
            return ["message" => "Actor creado con ID: " . $this->conn->insert_id];
        }
        return ["error" => $this->conn->error];
    }

    public function put($id, $data) {
        $first_name = $this->conn->real_escape_string($data['first_name']);
        $last_name  = $this->conn->real_escape_string($data['last_name']);
        $sql = "UPDATE actor SET first_name='$first_name', last_name='$last_name', last_update=NOW() 
                WHERE actor_id=$id";
        if ($this->conn->query($sql)) {
            return ["message" => "Actor $id actualizado"];
        }
        return ["error" => $this->conn->error];
    }

    public function delete($id) {
        $sql = "DELETE FROM actor WHERE actor_id=$id";
        if ($this->conn->query($sql)) {
            return ["message" => "Actor $id eliminado"];
        }
        return ["error" => $this->conn->error];
    }
}
?>
