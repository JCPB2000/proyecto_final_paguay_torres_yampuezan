<?php
// Controlador de Inicio: Muestra la página principal de la aplicación.
class InicioController {
    public function index() {
        include __DIR__ . "/../../views/index.php"; // Cargar la vista de inicio
    }
}
?>
