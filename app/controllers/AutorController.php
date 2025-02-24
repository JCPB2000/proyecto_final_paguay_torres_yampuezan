<?php
// Controlador de Autores: Gestiona la creación, edición, eliminación y obtención de autores.

require_once __DIR__ . "/../models/Autor.php";
require_once __DIR__ . "/../../config/database.php";

class AutorController {

    // Listar todos los autores
    public function index() {
        $db = Database::connect();
        $result = $db->query("SELECT * FROM autores");
        $autores = $result->fetchAll(PDO::FETCH_ASSOC);
        include __DIR__ . "/../../views/autores/index.php";
    }

    // Agregar un nuevo autor
    public function store() {
        $data = json_decode(file_get_contents("php://input"), true);
        if (empty($data['nombre'])) {
            echo json_encode(["success" => false, "message" => "Nombre requerido"]);
            return;
        }

        try {
            $db = Database::connect();
            $stmt = $db->prepare("INSERT INTO autores (nombre) VALUES (:nombre)");
            $stmt->execute(['nombre' => $data['nombre']]);
            echo json_encode(["success" => true, "message" => "Autor agregado"]);
        } catch (PDOException $e) {
            echo json_encode(["success" => false, "message" => "Error al agregar autor"]);
        }
    }

    // Actualizar un autor por su ID
    public function update($id) {
        $data = json_decode(file_get_contents("php://input"), true);
        if (empty($data['nombre'])) {
            echo json_encode(["success" => false, "message" => "Nombre requerido"]);
            return;
        }

        try {
            $db = Database::connect();
            $stmt = $db->prepare("UPDATE autores SET nombre = :nombre WHERE id = :id");
            $stmt->execute(['nombre' => $data['nombre'], 'id' => $id]);
            echo json_encode(["success" => true, "message" => "Autor actualizado"]);
        } catch (PDOException $e) {
            echo json_encode(["success" => false, "message" => "Error al actualizar autor"]);
        }
    }

    // Eliminar un autor por su ID
    public function delete($id) {
        try {
            $db = Database::connect();
            $stmt = $db->prepare("DELETE FROM autores WHERE id = :id");
            $stmt->execute(['id' => $id]);
            echo json_encode(["success" => true, "message" => "Autor eliminado"]);
        } catch (PDOException $e) {
            echo json_encode(["success" => false, "message" => "Error al eliminar autor"]);
        }
    }

    // Obtener un autor por su ID
    public function getAutor($id) {
        try {
            $db = Database::connect();
            $stmt = $db->prepare("SELECT * FROM autores WHERE id = :id");
            $stmt->execute(['id' => $id]);
            $autor = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($autor) {
                echo json_encode(["success" => true, "autor" => $autor]);
            } else {
                http_response_code(404);
                echo json_encode(["success" => false, "message" => "Autor no encontrado"]);
            }
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(["success" => false, "message" => "Error en la base de datos"]);
        }
    }
}
?>
