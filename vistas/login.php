<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../vistas/css/login.css">
</head>

<body>

    <div class="login-container">
        <h2>Iniciar sesión</h2>


        <form action="../controladores/loginControlador.php" method="POST">
            <div class="input-group">
                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" required>
            </div>

            <button type="submit">Iniciar sesión</button>

            <?php
            if (isset($_GET['error'])) {
                echo '<p class="error">' . htmlspecialchars($_GET['error']) . '</p>';
            }
            ?>
        </form>

        <p>No tienes una cuenta? <a href="registro.php">Regístrate</a></p>
    </div>

</body>

</html>