<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foro - Plataforma motivacional</title>
    <link rel="stylesheet" href="foro.css">
    <link rel="stylesheet" href="css/foro.css">

    <link rel="stylesheet" href="css/foro.css">
    <script src="../assets/js/foro.js"></script>

    <!--Aquí va el link para enlazar a foro.js-->

</head>

<body>
    <div class="contenedor-foro">
        <h2>COMUNIDAD DE APOYO</h2>
        <div id="contenedor-chat">
            <div id="mensajes">
                <!--Aquí se cargarán los mensajes-->
            </div>
        </div>
        <form id="formulario-mensaje">
            <input type="text" id="mensaje" name="mensaje" placeholder="Escribe tu testimonio aquí..." require>
            <button type="submit" class="boton-enviar">Enviar</button>
            <a href="../vistas/dashboard.php" class="boton-foro">Volver al incio</a>

        </form>
    </div>


</body>

</html>