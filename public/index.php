<?php
// Archivo de enrutamiento: Gestiona las rutas de la aplicación.

require_once __DIR__ . "/../app/core/Router.php";

$url = isset($_GET['url']) ? $_GET['url'] : 'inicio';

$router = new Router();
$router->add("inicio", "InicioController", "index");
$router->add("libros", "LibroController", "index");
$router->add("autores", "AutorController", "index");  // Se agrega ruta a autores

$router->add("api/libros", "LibroController", "store", "POST");
$router->add("api/libros/delete/([0-9]+)", "LibroController", "delete", "DELETE");
$router->add("api/libros/([0-9]+)", "LibroController", "getLibro", "GET"); // Obtener libro por ID
$router->add("api/libros/([0-9]+)", "LibroController", "update", "PUT"); 

$router->add("api/autores", "AutorController", "store", "POST");
$router->add("api/autores/delete/([0-9]+)", "AutorController", "delete", "DELETE");
$router->add("api/autores/([0-9]+)", "AutorController", "getAutor", "GET"); // Obtener autor por ID
$router->add("api/autores/([0-9]+)", "AutorController", "update", "PUT"); // Actualizar autor

$router->dispatch($url);
?>
