<?php
session_start(); // Iniciar sesión

require_once '../modelos/config.php'; // Conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $email = $_POST['email']; // Se usa el email para el login
    $contrasena = $_POST['contrasena'];

    // Consultar el usuario en la base de datos usando el email
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email); // Enlazar el email

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Usuario encontrado, verificar la contraseña
        $usuario_bd = $result->fetch_assoc();
        if (password_verify($contrasena, $usuario_bd['contrasena'])) {
            // Contraseña correcta, crear la sesión
            $_SESSION['usuario'] = $usuario_bd['nombre']; // Guardar nombre en la sesión
            $_SESSION['email'] = $usuario_bd['email']; // Guardar email en la sesión
            header("Location: dashboard.php"); // Redirigir al panel principal
            exit();
        } else {
            // Contraseña incorrecta
            $error = "Contraseña incorrecta";
        }
    } else {
        // Email no encontrado
        $error = "El email no está registrado";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
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
        <p>¿Es tu primera vez? <a href="registro.php">Regístrate</a></p>
        
        <!-- Imagen de usuario -->
        <img src="../assets/img/usuario.png" alt="Usuario" class="user-avatar">
        
        <form action="login.php" method="POST">
            <!-- Mostrar mensaje de error si existe -->
            <?php if (isset($error)): ?>
                <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <label for="email">Correo Electrónico</label>
            <input type="email" placeholder="email@example.com" id="email" name="email" class="login-input" required autocomplete="email">

            <label for="contrasena">Contraseña</label>
            <div class="input-container">
                <input type="password" placeholder="contraseña" id="contrasena" name="contrasena" class="login-input" required autocomplete="current-password">
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

    <!-- JavaScript para mostrar/ocultar la contraseña -->
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