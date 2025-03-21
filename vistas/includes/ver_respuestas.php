<?php
// Configuración de la base de datos
require_once 'modelos/config.php'; 

// Iniciar sesión y obtener el usuario_id
session_start();
if (isset($_SESSION['usuario_id'])) {
    $usuario_id = $_SESSION['usuario_id']; // Obtener el usuario_id de la sesión

    // Obtener las respuestas previas del usuario
    $sql = "SELECT titulo, contenido, fecha FROM post WHERE usuario_id = ? ORDER BY fecha DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    echo "Por favor, inicie sesión para ver sus respuestas.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Respuestas</title>
</head>
<body>

    <h1>Mis Respuestas Anteriores</h1>

    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div>
                <h3><?php echo htmlspecialchars($row['titulo']); ?> - <?php echo htmlspecialchars($row['fecha']); ?></h3>
                <p><?php echo nl2br(htmlspecialchars($row['contenido'])); ?></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No tienes respuestas anteriores.</p>
    <?php endif; ?>

</body>
</html>
