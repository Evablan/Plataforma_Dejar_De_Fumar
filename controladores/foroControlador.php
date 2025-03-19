<?php
session_start();
require_once '../modelos/config.php'; // Asegurar conexión a la base de datos
require_once '../modelos/foroModelo.php'; // Incluir el modelo

// Crear una instancia del modelo
$foro = new ForoModelo($conn);

// Procesar solicitud POST para insertar mensaje
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header('Content-Type: application/json'); // Asegurar respuesta JSON
    $usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : "Anónimo";
    $mensaje = $_POST['mensaje'] ?? '';

    if (!empty($mensaje)) {
        if ($foro->insertarMensaje($usuario, $mensaje)) {
            echo json_encode(['status' => 'success', 'message' => 'Mensaje enviado']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al enviar el mensaje']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'El mensaje no puede estar vacío']);
    }
}

// Procesar solicitud GET para obtener mensajes
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    header('Content-Type: application/json'); // Asegurar respuesta JSON
    echo json_encode($foro->obtenerMensajes());
}
?>
