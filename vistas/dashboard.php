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
    <link rel="stylesheet" href="../vistas/css/dashboard.css">
</head>

<body>
    <div class="dashboard-container">
        <h1 class="bienvenida">Bienvenido/a, <span class="nombre-usuario"><?php echo $usuario; ?></span>!</h1>
        <p class="mensaje-motivacional">Sigue así, cada día cuenta!</p>

        <div class="button-container">
            <a href="foro.php" class="button">Foro</a>
            <a href="blog.php" class="button">Blog</a>
            <a href="../controladores/cerrar_sesion.php" class="button cerrar">Cerrar sesión</a> 
        </div>


    </div>
</body>

</html>