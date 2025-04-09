<?php
require_once "../modelos/config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    exit("Método no permitido.");
}

$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : "Anónimo";

$mensaje = isset($_POST["mensaje"]) ? trim($_POST["mensaje"]) : "";
if (empty($mensaje)) {
    exit("El mensaje está vacío.");
}

$sql = "INSERT INTO publicaciones (usuario, mensaje) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $usuario, $mensaje);

if ($stmt->execute()) {
    header("Location: ../vistas/foro.php");
    exit;
} else {
    exit("Error al enviar el mensaje.");
}

$stmt->close();
$conn->close();
