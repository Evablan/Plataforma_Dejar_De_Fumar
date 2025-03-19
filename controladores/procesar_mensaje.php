<?php
require_once "../modelos/config.php"; // Conexión a la BD

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = "Usuario"; // Aquí puedes cambiarlo por la sesión del usuario logueado
    $mensaje = trim($_POST["mensaje"]);

    if (!empty($mensaje)) {
        $sql = "INSERT INTO publicaciones (usuario, mensaje) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $usuario, $mensaje);

        if ($stmt->execute()) {
            echo "Mensaje enviado";
        } else {
            echo "Error al enviar el mensaje.";
        }

        $stmt->close();
    }
}

$conn->close();
?>
