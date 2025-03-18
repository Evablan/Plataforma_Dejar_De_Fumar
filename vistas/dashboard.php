<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$usuario = isset($_SESSION['usuario']) ? htmlspecialchars($_SESSION['usuario']) : 'Usuario Desconocido';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de motivación y seguimiento</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap">
    <link rel="stylesheet" href="../vistas/css/dashboard.css">
</head>

<body>
    <div class="dashboard-container">
        <div class="icono-animado">
            <i class="fa-solid fa-face-smile-beam"></i>
        </div>

        <h1>Bienvenido/a,<br>
            <span class="nombre-usuario"><?php echo $usuario; ?></span>!
        </h1>

        <p class="mensaje-motivacional">
            Sigue así, cada día cuenta!
        </p>

        <div class="icono-celebracion">
            <i class="fa-solid fa-gift"></i>
        </div>

        <div class="button-container">
            <a href="foro.php" class="button">Foro</a>
            <a href="blog.php" class="button">Blog</a>
            <a href="../controladores/cerrar_sesion.php" class="button logout">Cerrar Sesión</a>
        </div>
    </div>
</body>

</html>