<?php
session_start(); 
require_once "../modelos/config.php"; 

$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foro - Plataforma motivacional</title>
    <link rel="stylesheet" href="css/foro.css">
    <script src="../assets/js/foro.js"></script>
</head>
<body>
    <div class="contenedor-foro">
        <h2>COMUNIDAD DE APOYO</h2>
        <div id="contenedor-chat">
            <div id="mensajes">
                <?php
                $sql = "SELECT usuario, mensaje, fecha FROM publicaciones ORDER BY fecha DESC";
                $resultado = $conn->query($sql);

                if ($resultado->num_rows > 0) {
                    while ($fila = $resultado->fetch_assoc()) {
                        echo "<p><strong>" . htmlspecialchars($fila['usuario']) . ":</strong> " . 
                             htmlspecialchars($fila['mensaje']) . " <em>(" . $fila['fecha'] . ")</em></p>";
                    }
                } else {
                    echo "<p>No hay mensajes aún. Sé el primero en escribir.</p>";
                }

                $conn->close();
                ?>
            </div>
        </div>
        <form id="formulario-mensaje" method="POST" action="../controladores/procesar_mensaje.php">
            <?php if (empty($usuario)) : ?>
                <input type="text" id="usuario" name="usuario" placeholder="Tu nombre..." required>
            <?php else : ?>
                <input type="hidden" name="usuario" value="<?php echo htmlspecialchars($usuario); ?>">
                <p>Escribiendo como: <strong><?php echo htmlspecialchars($usuario); ?></strong></p>
            <?php endif; ?>
            <input type="text" id="mensaje" name="mensaje" placeholder="Escribe tu testimonio aquí..." required>
            <button type="submit" class="boton-enviar">Enviar</button>
            <a href="../vistas/dashboard.php" class="boton-foro">Volver al inicio</a>
        </form>
    </div>
</body>
</html>
