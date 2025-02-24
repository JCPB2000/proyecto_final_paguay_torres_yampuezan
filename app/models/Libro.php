<?php
// Modelo Libro: Representa la estructura de un libro en la aplicación.

class Libro {
    public $id;
    public $titulo;
    public $autor_id;

    public function __construct($titulo, $autor_id, $id = null) {
        $this->titulo = htmlspecialchars(strip_tags($titulo)); // Sanitiza el título
        $this->autor_id = $autor_id;
        $this->id = $id;
    }
}
?>
