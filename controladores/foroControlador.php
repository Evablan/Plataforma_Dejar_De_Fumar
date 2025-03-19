<?php
require_once "../modelos/config.php"; // Conectar a la BD
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'] ?? "Anónimo"; // Tomar el usuario
    $mensaje = trim($_POST['mensaje'] ?? "");

    if (!empty($mensaje)) {
        $sql = "INSERT INTO publicaciones (usuario, mensaje) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $usuario, $mensaje);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "No se pudo guardar"]);
        }

        $stmt->close();
        exit;
    }
}

// Si no es POST, devolver los mensajes
$sql = "SELECT usuario, mensaje, fecha FROM publicaciones ORDER BY fecha DESC";
$resultado = $conn->query($sql);

$mensajes = [];

while ($fila = $resultado->fetch_assoc()) {
    $mensajes[] = $fila;
}

echo json_encode($mensajes);
$conn->close();
?>
