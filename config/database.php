<?php
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
