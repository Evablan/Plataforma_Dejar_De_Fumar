<?php
header('Content-Type: application/json');
require_once 'modelos/guardar_post.php'; // Incluye el modelo

// Verificar si la solicitud es un POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el ID del usuario y las respuestas
    $data = json_decode(file_get_contents("php://input"), true);
    if (isset($data['usuario_id']) && isset($data['preguntas'])) {
        $usuario_id = $data['usuario_id'];
        $preguntas = $data['preguntas'];

        // Guardar las respuestas en la base de datos
        guardarRespuestas($usuario_id, $preguntas);

        echo json_encode(["status" => "success", "message" => "Respuestas guardadas correctamente"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Datos incompletos"]);
    }
}
?>
