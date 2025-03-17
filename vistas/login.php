<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="inicio">
        <h1>Inicio de Sesión</h1>
        <p>¿Es tú primera vez? <a href="registro.php">Regístrate</a></p>
        <!--Imagen de usuario -->
        <img src="../assets/img/usuario.png" alt="Usuario" class="user-avatar">
        <form action="dashboard.php" method="POST">

            <label for="usuario">Usuario</label>
            <input placeholder="usuario" id="usuario" name="usuario" class="login-input" required autocomplete="username">

            <label for="contrasena">Contraseña</label>
            <div class="input-container">
                <input placeholder="contraseña" id="contrasena" name="contrasena" class="login-input" required autocomplete="current-password">
                <span class="toggle-password">
                    <i id="icon-eye" class="fa-solid fa-eye"></i>
                </span>
            </div>
            <div class="button-login">
                <button type="submit" class="button">ENTRAR</button>
            </div>

            <p>¿Olvidaste tu contraseña?</p>
        </form>
    </div>
    <!-- JavaScript -->
    <script>
        document.querySelector('.toggle-password').addEventListener('click', function() {
            const passwordInput = document.getElementById('contrasena');
            const iconEye = document.getElementById('icon-eye');



            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                iconEye.classList.remove('fa-eye');
                iconEye.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                iconEye.classList.remove('fa-eye-slash');
                iconEye.classList.add('fa-eye');
            }
        })
    </script>
</body>

</html>