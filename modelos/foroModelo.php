<?php
require_once 'config.php'; // Asegurar conexión en caso de acceso directo al modelo

class ForoModelo {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Método para insertar un mensaje
    public function insertarMensaje($usuario, $mensaje) {
        $sql = "INSERT INTO publicaciones (usuario, mensaje, fecha) VALUES (?, ?, NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $usuario, $mensaje);
        return $stmt->execute();
    }

    // Método para obtener los mensajes
    public function obtenerMensajes() {
        $sql = "SELECT usuario, mensaje, fecha FROM publicaciones ORDER BY fecha DESC";
        $result = $this->conn->query($sql);
        $mensajes = $result->fetch_all(MYSQLI_ASSOC);
        return $mensajes;
    }
}
?>
