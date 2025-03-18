<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../vistas/css/login.css">
</head>

<body>
    <div class="inicio">
        <h1>Inicio de Sesión</h1>
        <p>¿Es tu primera vez? <a href="registro.php">Regístrate</a></p>

        <form action="../controladores/procesar_login.php" method="POST">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required autocomplete="email">

            <label for="contrasena">Contraseña</label>
            <input type="password" id="contrasena" name="contrasena" required autocomplete="current-password">

            <button type="submit">ENTRAR</button>
        </form>

        <?php
        // Mostrar mensaje de error si existe
        if (isset($_GET['error'])) {
            echo "<p style='color:red'>" . htmlspecialchars($_GET['error']) . "</p>";
        }
        ?>
    </div>
</body>

</html>