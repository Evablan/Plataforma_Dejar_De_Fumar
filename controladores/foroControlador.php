<?php
require_once '../config/database.php'; // Conexión a la base de datos

header('Content-Type: application/json'); // Asegura que todas las respuestas sean JSON

class ForoControlador {
    private $conexion;

    public function __construct() {
        $this->conectarBD();
    }

    private function conectarBD() {
        try {
            $this->conexion = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, // ❗ AQUÍ SE DEBE PONER EL NOMBRE REAL DE LA BASE DE DATOS
                DB_USER,
                DB_PASS,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException $e) {
            echo json_encode(["error" => "Error de conexión: " . $e->getMessage()]);
            exit();
        }
    }

    public function procesarSolicitud($metodo, $datos) {
        switch ($metodo) {
            case 'POST':
                return $this->agregarMensaje($datos);
            case 'GET':
                return $this->obtenerMensajes();
            default:
                return ["error" => "Método no permitido"];
        }
    }

    private function obtenerMensajes() {
        try {
            $sql = "SELECT usuario, mensaje, fecha FROM mensajes ORDER BY fecha DESC";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            return ["error" => "Error al obtener mensajes: " . $e->getMessage()];
        }
    }

    private function agregarMensaje($datos) {
        session_start();
        $usuario = $_SESSION['usuario'] ?? 'Anónimo';
        $mensaje = trim($datos['mensaje'] ?? '');

        if (!empty($usuario) && !empty($mensaje)) {
            try {
                $sql = "INSERT INTO mensajes (usuario, mensaje, fecha) VALUES (:usuario, :mensaje, NOW())";
                $stmt = $this->conexion->prepare($sql);
                $stmt->bindParam(":usuario", $usuario);
                $stmt->bindParam(":mensaje", $mensaje);
                $stmt->execute();
                return ["success" => true];
            } catch (PDOException $e) {
                return ["error" => "Error al agregar mensaje: " . $e->getMessage()];
            }
        }
        return ["error" => "Usuario o mensaje vacío"];
    }
}

// Manejo de solicitudes AJAX
$foro = new ForoControlador();
echo json_encode($foro->procesarSolicitud($_SERVER['REQUEST_METHOD'], $_POST));
exit();
