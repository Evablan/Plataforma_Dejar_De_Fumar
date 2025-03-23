<?php
session_start();
$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preguntas Diarias</title>
    <link rel="stylesheet" href="../css/blog.css">
</head>
<body>
    <div class="contenedor-foro">
        <h2>Responde la Pregunta del Día</h2>
        <form method="POST" action="../controladores/PreguntaControlador.php">
            <input type="hidden" name="usuario" value="<?php echo htmlspecialchars($usuario); ?>">
            <label for="pregunta">¿Cómo te has sentido hoy sin fumar?</label>
            <textarea name="respuesta" required></textarea>
            <button type="submit">Enviar Respuesta</button>
        </form>
        <a href="historial_respuestas.php">Ver Respuestas Anteriores</a>
    </div>
</body>
</html>
