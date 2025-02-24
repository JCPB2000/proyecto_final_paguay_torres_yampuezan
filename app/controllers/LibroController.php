<?php
require_once __DIR__ . "/../models/Libro.php";
require_once __DIR__ . "/../models/Autor.php";
require_once __DIR__ . "/../../config/database.php";

class LibroController {
    public function index() {
        $db = Database::connect();

        // Obtener libros con el nombre del autor
        $result = $db->query("SELECT libros.id, libros.titulo, autores.nombre as autor 
                              FROM libros 
                              JOIN autores ON libros.autor_id = autores.id");
        $libros = $result->fetchAll(PDO::FETCH_ASSOC);

        include __DIR__ . "/../../views/libros/index.php";
    }

    public function getLibro($id) {
        try {
            $db = Database::connect();
            $stmt = $db->prepare("SELECT libros.id, libros.titulo, autores.nombre as autor 
                                  FROM libros 
                                  JOIN autores ON libros.autor_id = autores.id 
                                  WHERE libros.id = :id");
            $stmt->execute(['id' => $id]);
            $libro = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($libro) {
                echo json_encode(["success" => true, "libro" => $libro]);
            } else {
                echo json_encode(["success" => false, "message" => "Libro no encontrado"]);
            }
        } catch (PDOException $e) {
            echo json_encode(["success" => false, "message" => "Error en la base de datos"]);
        }
    }

    public function store() {
        $data = json_decode(file_get_contents("php://input"), true);
        
        if (empty($data['titulo']) || empty($data['autor'])) {
            echo json_encode(["success" => false, "message" => "Faltan datos"]);
            return;
        }
    
        try {
            $db = Database::connect();
    
            // Verificar si el autor ya existe
            $stmt = $db->prepare("SELECT id FROM autores WHERE nombre = :autor");
            $stmt->execute(['autor' => $data['autor']]);
            $autor = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if (!$autor) {
                // Si el autor no existe, crearlo
                $stmt = $db->prepare("INSERT INTO autores (nombre) VALUES (:autor)");
                $stmt->execute(['autor' => $data['autor']]);
                $autor_id = $db->lastInsertId();
            } else {
                $autor_id = $autor['id'];
            }
    
            // Insertar el libro con el ID del autor
            $stmt = $db->prepare("INSERT INTO libros (titulo, autor_id) VALUES (:titulo, :autor_id)");
            $stmt->execute([
                'titulo' => $data['titulo'],
                'autor_id' => $autor_id
            ]);
    
            echo json_encode(["success" => true, "message" => "Libro agregado exitosamente"]);
        } catch (PDOException $e) {
            echo json_encode(["success" => false, "message" => "Error al agregar libro"]);
        }
    }

    public function delete($id) {
        try {
            $db = Database::connect();
            $stmt = $db->prepare("DELETE FROM libros WHERE id = :id");
            $stmt->execute(['id' => $id]);

            echo json_encode(["success" => true, "message" => "Libro eliminado correctamente"]);
        } catch (PDOException $e) {
            echo json_encode(["success" => false, "message" => "Error al eliminar libro"]);
        }
    }

    public function update($id) {
        $data = json_decode(file_get_contents("php://input"), true);
        
        if (empty($data['titulo']) || empty($data['autor'])) {
            echo json_encode(["success" => false, "message" => "Faltan datos"]);
            return;
        }
    
        try {
            $db = Database::connect();
    
            // Verificar si el autor ya existe
            $stmt = $db->prepare("SELECT id FROM autores WHERE nombre = :autor");
            $stmt->execute(['autor' => $data['autor']]);
            $autor = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if (!$autor) {
                // Si el autor no existe, crearlo
                $stmt = $db->prepare("INSERT INTO autores (nombre) VALUES (:autor)");
                $stmt->execute(['autor' => $data['autor']]);
                $autor_id = $db->lastInsertId();
            } else {
                $autor_id = $autor['id'];
            }
    
            // Actualizar el libro
            $stmt = $db->prepare("UPDATE libros SET titulo = :titulo, autor_id = :autor_id WHERE id = :id");
            $stmt->execute([
                'titulo' => $data['titulo'],
                'autor_id' => $autor_id,
                'id' => $id
            ]);
    
            echo json_encode(["success" => true, "message" => "Libro actualizado exitosamente"]);
        } catch (PDOException $e) {
            echo json_encode(["success" => false, "message" => "Error al actualizar libro"]);
        }
    }
    
}
?>
