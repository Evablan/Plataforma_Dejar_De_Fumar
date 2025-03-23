<?php
class Imagen {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    //  Guardar imagen en la base de datos
    public function subirImagen($id_usuario, $nombreArchivo, $ruta) {
        $sql = "INSERT INTO imagenes (id_usuario, nombre_archivo, ruta) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iss", $id_usuario, $nombreArchivo, $ruta);
        return $stmt->execute();
    }

    // Obtener imágenes de un usuario
    public function obtenerImagenes($id_usuario) {
        $imagenes = [];
        $sql = "SELECT nombre_archivo, ruta FROM imagenes WHERE id_usuario = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        while ($fila = $resultado->fetch_assoc()) {
            $imagenes[] = $fila;
        }
        return $imagenes;
    }
}
?>
