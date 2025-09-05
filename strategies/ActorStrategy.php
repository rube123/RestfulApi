<?php
// actorStrategy.php
// ------------------------
// Aquí se define el **Strategy Pattern**: ActorStrategy es una interfaz que permite intercambiar 
// distintas implementaciones de acceso a actores (podría ser MySQL, SQLite, API externa, etc.)

interface ActorStrategy {
    public function get($id = null);
    public function post($data);
    public function put($id, $data);
    public function delete($id);
}
?>
