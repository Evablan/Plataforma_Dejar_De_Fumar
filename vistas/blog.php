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
        <!-- Ahorro (parte superior derecha) -->
        <label for="diasSinFumar">Días sin fumar:</label>
        <input type="number" id="diasSinFumar" min="0" value="0">
        <button onclick="calcularAhorro()">Calcular Ahorro</button>
        <div class="ahorro">
            <h2>Ahorros Acumulados</h2>
            <p id="totalAhorro">Cargando...</p>
        </div>

        <!-- Imágenes (lado izquierdo) -->
        <div class="imagenes">
            <h2>Inspírate</h2>
            <p>Sube una imagen que represente tu meta de este año</p>
            <input type="file">
        </div>

        <!-- Preguntas (lado derecho, parte inferior) -->
        <div class="preguntas">
            <label>¿Qué logro pequeño celebras hoy en tu camino para dejar de fumar?</label>
            <textarea id="pregunta1"></textarea>

            <label>¿Cómo te sentiste hoy al respirar profundamente sin el humo del tabaco?</label>
            <textarea id="pregunta2"></textarea>

            <label>¿Qué cosa nueva o positiva hiciste hoy para cuidar tu salud?</label>
            <textarea id="pregunta3"></textarea>

            <label>¿Qué palabras de aliento te dirías a ti mismo para seguir adelante?</label>
            <textarea id="pregunta4"></textarea>

            <label>¿Qué disfrutaste hoy que antes pasabas por alto cuando fumabas?</label>
            <textarea id="pregunta5"></textarea>

            <label>¿Qué aspecto de tu vida ha mejorado desde que comenzaste este cambio?</label>
            <textarea id="pregunta6"></textarea>

            <button class="boton-guardar" onclick="guardarReflexion()">Guardar Reflexión</button>
            <br>
            <a href="ver_respuestas.php" class="ver-respuestas">Ver respuestas anteriores</a>
        </div>
    </div>

    <!-- Mover el script de calculadora.js aquí -->
    <script src="../assets/js/calculadora.js"></script>
    <script src="../assets/js/preguntas.js"></script> <!-- Nuevo archivo JavaScript -->
</body>

</html>

