<?php
require_once 'modelos/config.php'; // Incluye la conexión a la base de datos

// Función para guardar las respuestas
function guardarRespuestas($usuario_id, $preguntas) {
    global $conn;
    $fecha = date("Y-m-d");

    foreach ($preguntas as $pregunta) {
        $titulo = $pregunta['titulo'];
        $contenido = $pregunta['contenido'];

        // Preparar la consulta para insertar las respuestas
        $sql = "INSERT INTO post (usuario_id, titulo, contenido, fecha) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $usuario_id, $titulo, $contenido, $fecha);
        $stmt->execute();
    }
}
?>
