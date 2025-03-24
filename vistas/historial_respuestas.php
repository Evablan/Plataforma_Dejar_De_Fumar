<?php
session_start();
require_once "../modelos/Pregunta.php";

$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : '';
$preguntaModelo = new Pregunta();
$respuestas = $preguntaModelo->obtenerRespuestasPorUsuario($usuario);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Respuestas</title>
    <link rel="stylesheet" href="../vistas/css/historial_respuestas.css">
</head>

<body>
    <div class="contenedor-foro">
        <h2>Historial de Respuestas</h2>
        <a href="../vistas/blog.php" class="boton-blog">Volver al Blog</a>
        <ul>
            <?php if (!empty($respuestas)) : ?>
                <?php foreach ($respuestas as $respuesta) : ?>
                    <li>
                        <strong><?php echo htmlspecialchars($respuesta['pregunta']); ?>:</strong>
                        <?php echo htmlspecialchars($respuesta['respuesta']); ?>
                        <em>(<?php echo $respuesta['fecha']; ?>)</em>
                    </li>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No has respondido preguntas aún.</p>
            <?php endif; ?>
        </ul>
    </div>
</body>

</html>