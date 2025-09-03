<?php
interface ActorStrategy {
    public function get($id = null);
    public function post($data);
    public function put($id, $data);
    public function delete($id);
}
?>
