<?php
// Modelo Autor: Representa la estructura de un autor en la aplicación.
class Autor {
    public $id;
    public $nombre;

    public function __construct($nombre, $id = null) {
        $this->nombre = htmlspecialchars(strip_tags($nombre));
        $this->id = $id;
    }
}
?>
