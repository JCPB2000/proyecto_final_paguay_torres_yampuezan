# Introducción

Este sistema ha sido diseñado con una estructura modular, lo que permite su fácil mantenimiento y escalabilidad. 
Gracias a la implementación del patrón MVC, la separación de responsabilidades facilita la incorporación de nuevas 
funcionalidades sin afectar la estabilidad del código. Además, el uso de PDO en la conexión a la base de datos garantiza 
una interacción segura y eficiente con MySQL, evitando vulnerabilidades como inyección SQL. 
La integración de Axios permite una comunicación fluida entre el frontend y el backend, optimizando la experiencia 
del usuario al reducir la necesidad de recargas de página. Como resultado, esta plataforma puede ser
utilizada en diversos entornos, desde bibliotecas hasta colecciones privadas, con la flexibilidad de 
adaptarse a futuras mejoras y necesidades específicas.

## 1. Estructura del Proyecto
```
proyecto_final_paguay_torres_yampuezan/
├── app/
│   ├── controllers/
│   │   ├── AutorController.php
│   │   ├── InicioController.php
│   │   ├── LibroController.php
│   ├── core/
│   │   ├── Router.php
│   ├── models/
│   │   ├── Autor.php
│   │   ├── Libro.php
├── assets/
│   ├── css/
│   │   ├── style.css
│   ├── js/
│   │   ├── scripts.js
├── config/
│   ├── database.php
├── public/
│   ├── .htaccess
│   ├── index.php
│   ├── test.php
├── views/
│   ├── index.php
│   ├── autores/
│   │   ├── index.php
│   ├── libros/
│   │   ├── index.php
│   │   ├── form.php
│   ├── layouts/
│   │   ├── menu.php
├── DOCUMENTACION.md
├── README.md
├── database.sql


```

## 2. Funcionamiento del Router

El router está implementado en app/core/Router.php. Su función principal es manejar las rutas y dirigirlas al controlador
correspondiente. Este router permite gestionar la navegación de la aplicación de manera eficiente y flexible, facilitando 
la adición de nuevas rutas sin modificar directamente el código principal.

Ejemplo de definición de rutas en public/index.php:
El router analiza la URL y ejecuta el método correspondiente del controlador.

```
require_once __DIR__ . '/../app/core/Router.php';

$router = new Router();
$router->add("inicio", "InicioController", "index");
$router->add("libros", "LibroController", "index");
$router->add("autores", "AutorController", "index");
$router->add("api/libros", "LibroController", "store", "POST");
$router->add("api/libros/delete/{id}", "LibroController", "delete", "DELETE");
$router->add("api/libros/{id}", "LibroController", "getLibro", "GET");
$router->dispatch($_GET['url'] ?? 'inicio');
```
El router analiza la URL y ejecuta el método correspondiente del controlador, asegurando una mejor 
organización y separación de responsabilidades dentro del sistema.




## 3. Uso de Axios para Peticiones HTTP

Axios se usa en la interfaz para manejar peticiones HTTP a la API. Este enfoque permite realizar solicitudes asincrónicas sin recargar la página, 
mejorando la experiencia del usuario y optimizando el rendimiento del sistema.

Agregar un nuevo libro

  ![Proyecto](https://github.com/JCPB2000/proyecto_final_paguay_torres_yampuezan/blob/main/Image%202025-02-23%20at%209.33.59%20PM.jpeg)
```
document.getElementById("formLibro").addEventListener("submit", function(event) {
    event.preventDefault();
    const titulo = document.getElementById("titulo").value.trim();
    const autor = document.getElementById("autor").value.trim();
    
    if (!titulo || !autor) {
        alert("Por favor, complete todos los campos.");
        return;
    }
    
    axios.post("/proyecto_final_paguay_torres_yampuezan/public/api/libros", {
        titulo: titulo,
        autor: autor
    })
    .then(response => {
        alert("Libro agregado con éxito");
        location.reload();
    })
    .catch(error => {
        console.error("Error al agregar libro:", error);
        alert("Hubo un problema al guardar el libro.");
    });
});
```

## Eliminar un libro
```
document.querySelectorAll(".btn-eliminar").forEach(button => {
    button.addEventListener("click", function() {
        const id = this.getAttribute("data-id");
        if (confirm("¿Seguro que deseas eliminar este libro?")) {
            axios.delete(`/proyecto_final_paguay_torres_yampuezan/public/api/libros/delete/${id}`)
            .then(response => {
                alert(response.data.message);
                location.reload();
            })
            .catch(error => {
                console.error("Error al eliminar:", error);
                alert("Hubo un error al eliminar el libro.");
            });
        }
    });
});
```
## 4. Configuración de la Base de Datos

El archivo config/database.php maneja la conexión a MySQL utilizando PDO. Esta implementación garantiza una conexión segura y optimizada con la base de datos, evitando inyecciones SQL y proporcionando 
una capa de abstracción eficiente. Además, se configura para manejar errores de manera estructurada, asegurando la estabilidad del sistema.
```
class Database {
    private static $host = "127.0.0.1";
    private static $db = "proyecto_final_paguay_torres_yampuezan";
    private static $user = "root";
    private static $pass = "";
    private static $conn = null;

    public static function connect() {
        if (self::$conn === null) {
            try {
                self::$conn = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$db, self::$user, self::$pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
            } catch (PDOException $e) {
                die(json_encode(["success" => false, "message" => "Error en la base de datos"]));
            }
        }
        return self::$conn;
    }
}
```
## Equipo de Desarrollo
Este proyecto fue desarrollado como parte de una actividad académica. Los integrantes del equipo son:

* Julio Cesar Paguay Bonilla
* Tiffani Nathalia Torres Díaz
* Yampuezan Burbano Verónica Janeth

## FIN
