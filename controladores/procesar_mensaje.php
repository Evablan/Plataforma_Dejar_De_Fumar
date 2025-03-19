<?php
require_once "../modelos/config.php"; // Conexión a la BD
session_start();

// Verificar si la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    exit("Método no permitido.");
}

// Obtener usuario de la sesión o asignar "Anónimo"
$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : "Anónimo";

// Verificar que el mensaje no esté vacío
$mensaje = isset($_POST["mensaje"]) ? trim($_POST["mensaje"]) : "";
if (empty($mensaje)) {
    exit("El mensaje está vacío.");
}

// Insertar mensaje en la base de datos
$sql = "INSERT INTO publicaciones (usuario, mensaje) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $usuario, $mensaje);

if ($stmt->execute()) {
    // Redirigir al foro para ver los mensajes actualizados
    header("Location: ../vistas/foro.php");
    exit;
} else {
    exit("Error al enviar el mensaje.");
}

// Cerrar conexión
$stmt->close();
$conn->close();
