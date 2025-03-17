<?php
require_once '../lib/GestorSesiones.php';

session_start();

/*$usuario = gestorSesiones::obtenerUsuario();*/
/*$usuario = "Raquel";*/

/*
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}




// Obtiene el nombre del usuario de la sesión
$usuario = $_SESSION['usuario'];*/
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de motivación y seguimiento</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> <!--Biblioteca de animaciones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> <!--Biblioteca de iconos fontawesome-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap"> <!--Biblioteca google-fonts poopins-->
    <link rel="stylesheet" href="css/dashboard.css"> <!--Hoja de estilos-->
</head>

<body>
    <div class="dashboard-container">
        <div class="icono-animado animate__animated __animate__tada"> <!--Aquí especificamos la animación desde la biblioteca anymate.style" -->
            <i class="fa-solid fa-face-smile-beam"></i>
        </div>

        <h1>Bienvenida,<br>

            <h1>Bienvenido/a,<br>

                <span class="nombre-usuario"><?php echo htmlspecialchars($usuario); ?></span>!
            </h1>
            <p class="mensaje-motivacional">
                Sigue así, cada día<br>cuenta!
            </p>
            <div class="icono-celebracion">
                <i class="fa-solid fa-gift"></i>
            </div>


            <div class="button-foro">
                <button type="submit" class="button">Foro</button>
            </div>
    </div>

    <div class="button-container">

        <a href="foro.php" class="button">Foro</a>
        <a href="blog.php" class="button">Blog</a>

    </div>
    </div>


</body>

</html>