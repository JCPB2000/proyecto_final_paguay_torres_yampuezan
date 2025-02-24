﻿# proyecto_final_paguay_torres_yampuezan
 
Proyecto: Sistema de Gestión de Libros y Autores

Descripción

Este proyecto es una aplicación web desarrollada en PHP que permite la gestión de libros y autores de manera eficiente. 
Se utiliza el patrón de diseño MVC (Modelo-Vista-Controlador) para mantener una estructura modular y escalable.

La aplicación permite:

* Registrar, editar y eliminar libros.

* Gestionar autores.

* Manejar datos en una base de datos MySQL.

* Interactuar con el backend mediante peticiones HTTP utilizando Axios.

* Implementar un sistema de enrutamiento basado en reglas definidas en un router centralizado.

* Generar vistas dinámicas para una mejor experiencia del usuario.

  ![Proyecto](https://github.com/JCPB2000/proyecto_final_paguay_torres_yampuezan/blob/main/Image%202025-02-23%20at%209.32.23%20PM.jpeg)

# Tecnologías Utilizadas

* Tecnologías Utilizadas

* Lenguaje Backend: PHP 8+

* Base de Datos: MySQL

* Cliente HTTP: Axios

* Estilos: CSS3, Bootstrap 5

* Servidor Web: Apache con XAMPP o Laragon

* Arquitectura: MVC

* Manejo de Rutas: .htaccess y PHP



## **Estructura del Proyecto**

```
proyecto_final_paguay_torres_yampuezan/
├── app/                      # Lógica de la aplicación
│   ├── controllers/          # Controladores del sistema
│   │   ├── AutorController.php
│   │   ├── InicioController.php
│   │   ├── LibroController.php
│   ├── core/                 # Router de la aplicación
│   │   ├── Router.php
│   ├── models/               # Modelos de datos
│   │   ├── Autor.php
│   │   ├── Libro.php
├── assets/                   # Recursos estáticos
│   ├── css/                  # Archivos de estilo
│   │   ├── style.css
│   ├── js/                   # Scripts de la aplicación
│   │   ├── scripts.js
├── config/                   # Configuración del sistema
│   ├── database.php          # Conexión a la base de datos
├── public/                   # Punto de acceso web
│   ├── .htaccess             # Reescritura de URLs
│   ├── index.php             # Punto de entrada principal
│   ├── test.php              # Archivo de prueba
├── views/                    # Vistas del sistema
│   ├── index.php             # Página principal
│   ├── autores/              # Vistas relacionadas con autores
│   │   ├── index.php
│   ├── libros/               # Vistas relacionadas con libros
│   │   ├── index.php
│   │   ├── form.php
│   ├── layouts/              # Componentes reutilizables
│   │   ├── menu.php          # Menú de navegación
├── DOCUMENTACION.md          # Documentación detallada del proyecto
├── README.md                 # Introducción y guía de instalación

```
## Crear una base de datos en MySQL:
```
CREATE DATABASE proyecto_final_paguay_torres_yampuezan;
```
## Importar el archivo database.sql incluido en el proyecto.
```
/**
 * Clase Database
 * Maneja la conexión a la base de datos utilizando PDO.
 */
class Database {
    private static $host = "127.0.0.1";
    private static $db = "proyecto_final_paguay_torres_yampuezan";
    private static $user = "root";
    private static $pass = "";
    private static $conn = null;

    /**
     * Conecta con la base de datos y devuelve la instancia PDO.
     */
    public static function connect() {
        if (self::$conn === null) {
            try {
                self::$conn = new PDO("mysql:host=".self::$host.";dbname=".self::$db, self::$user, self::$pass, [
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
?>

```
## Uso del Sistema

Uso del Sistema

Gestionar Libros

Acceder a http://localhost/proyecto_final_paguay_torres_yampuezan/public/libros

* Agregar, editar o eliminar libros de la base de datos.

* Visualizar información detallada de cada libro registrado.

![Proyecto](![Proyecto](https://github.com/JCPB2000/proyecto_final_paguay_torres_yampuezan/blob/main/Image%202025-02-23%20at%209.32.23%20PM.jpeg))

Gestionar Autores

* Acceder a http://localhost/proyecto_final_paguay_torres_yampuezan/public/autores

* Crear, modificar o eliminar autores.

* Relacionar autores con los libros de forma dinámica.

![Proyecto](https://github.com/JCPB2000/proyecto_final_paguay_torres_yampuezan/blob/main/Image%202025-02-23%20at%209.35.12%20PM.jpeg)

## Autores

Julio Cesar Paguay Bonilla

Tiffani Nathalia Torres Díaz

Yampuezan Burbano Verónica Janeth


## FIN



