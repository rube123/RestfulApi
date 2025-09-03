<?php
include "db.php";
include "ActorStrategy.php";

class MySQLActor implements ActorStrategy {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

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
