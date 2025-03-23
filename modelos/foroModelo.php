<?php
require_once 'config.php'; 

class ForoModelo {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function insertarMensaje($usuario, $mensaje) {
        $sql = "INSERT INTO publicaciones (usuario, mensaje, fecha) VALUES (?, ?, NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $usuario, $mensaje);
        return $stmt->execute();
    }

    public function obtenerMensajes() {
        $sql = "SELECT usuario, mensaje, fecha FROM publicaciones ORDER BY fecha DESC";
        $result = $this->conn->query($sql);
        $mensajes = $result->fetch_all(MYSQLI_ASSOC);
        return $mensajes;
    }
}
?>
