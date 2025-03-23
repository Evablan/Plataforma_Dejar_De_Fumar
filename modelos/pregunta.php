<?php
require_once "config.php"; // Archivo de conexión a la base de datos

class Pregunta {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function guardarRespuesta($usuario, $pregunta, $respuesta) {
        $sql = "INSERT INTO respuestas (usuario, pregunta, respuesta, fecha) VALUES (?, ?, ?, NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $usuario, $pregunta, $respuesta);
        return $stmt->execute();
    }

    public function obtenerRespuestasPorUsuario($usuario) {
        $sql = "SELECT pregunta, respuesta, fecha FROM respuestas WHERE usuario = ? ORDER BY fecha DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
}
?>
