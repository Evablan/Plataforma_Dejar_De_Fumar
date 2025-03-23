<?php
session_start(); 
require_once "../modelos/config.php"; 
require_once "../modelos/img.php";

$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : '';
$id_usuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null;

$respuestas = [];
if ($id_usuario) {
    $sql = "SELECT pregunta, respuesta FROM respuestas WHERE usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    while ($fila = $resultado->fetch_assoc()) {
        $respuestas[$fila['pregunta']] = $fila['respuesta'];
    }

    // Obtener imágenes del usuario
    $imagenModel = new Imagen($conn);
    $imagenes = $imagenModel->obtenerImagenes($id_usuario);
} else {
    $imagenes = [];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="css/blog.css">
</head>

<body>
    <div class="contenedor">
        <label for="diasSinFumar">Días sin fumar:</label>
        <input type="number" id="diasSinFumar" min="0" value="0">
        <button onclick="calcularAhorro()">Calcular Ahorro</button>
        <div class="ahorro">
            <h2>Ahorros Acumulados</h2>
            <p id="totalAhorro">Cargando...</p>
        </div>

        <!-- Sección de imágenes -->
        <div class="imagenes">
            <h2>Inspírate</h2>
            <p>Sube una imagen que represente tu meta de este año</p>
            
            <!-- Formulario para subir imágenes -->
            <form action="../controladores/imagenControlador.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
                <input type="file" name="imagen" required>
                <button type="submit">Subir Imagen</button>
            </form>

            <!-- Galería de imágenes -->
            <h3>Imágenes Subidas</h3>
            <div class="galeria">
                <?php if (!empty($imagenes)): ?>
                    <?php foreach ($imagenes as $img): ?>
                        <img src="/Plataforma_Dejar_De_Fumar/<?php echo htmlspecialchars($img['ruta']); ?>" width="350" alt="Imagen subida">

                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No hay imágenes subidas aún.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Sección de preguntas y reflexiones -->
        <div class="preguntas">
            <h2>Reflexiona sobre tu proceso</h2>
            <form id="formPreguntas" method="POST" action="../controladores/preguntaControlador.php">
                <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">

                <label>¿Qué logro pequeño celebras hoy en tu camino para dejar de fumar?</label>
                <textarea name="pregunta1"><?php echo isset($respuestas['pregunta1']) ? htmlspecialchars($respuestas['pregunta1']) : ''; ?></textarea>

                <label>¿Cómo te sentiste hoy al respirar profundamente sin el humo del tabaco?</label>
                <textarea name="pregunta2"><?php echo isset($respuestas['pregunta2']) ? htmlspecialchars($respuestas['pregunta2']) : ''; ?></textarea>

                <label>¿Qué cosa nueva o positiva hiciste hoy para cuidar tu salud?</label>
                <textarea name="pregunta3"><?php echo isset($respuestas['pregunta3']) ? htmlspecialchars($respuestas['pregunta3']) : ''; ?></textarea>

                <label>¿Qué palabras de aliento te dirías a ti mismo para seguir adelante?</label>
                <textarea name="pregunta4"><?php echo isset($respuestas['pregunta4']) ? htmlspecialchars($respuestas['pregunta4']) : ''; ?></textarea>

                <label>¿Qué disfrutaste hoy que antes pasabas por alto cuando fumabas?</label>
                <textarea name="pregunta5"><?php echo isset($respuestas['pregunta5']) ? htmlspecialchars($respuestas['pregunta5']) : ''; ?></textarea>

                <label>¿Qué aspecto de tu vida ha mejorado desde que comenzaste este cambio?</label>
                <textarea name="pregunta6"><?php echo isset($respuestas['pregunta6']) ? htmlspecialchars($respuestas['pregunta6']) : ''; ?></textarea>

                <button type="submit" class="boton-guardar">Guardar Reflexión</button>
            </form>
            <br>
            <a href="historial_respuestas.php" class="ver-respuestas">Ver respuestas anteriores</a>
            <a href="../vistas/dashboard.php" class="boton-blog">Volver al inicio</a>
        </div>
    </div>

    <script src="../assets/js/calculadora.js"></script>
</body>

</html>
