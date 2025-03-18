<?php
require_once '../modelos/config.php'; // Asegúrate de que la ruta es correcta

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura de datos del formulario
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    $confirmContrasena = $_POST['confirmContrasena'];

    // Verificar que las contraseñas coincidan
    if ($contrasena !== $confirmContrasena) {
        header("Location: ../vistas/registro.php?error=Las contraseñas no coinciden");
        exit();
    }

    // 1️⃣ Verificar si el email ya está registrado
    $sql_check = "SELECT id FROM usuarios WHERE email = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        // ❌ Error: el email ya está registrado
        header("Location: ../vistas/registro.php?error=El correo electrónico ya está registrado");
        exit();
    }
    $stmt_check->close();

    // Encriptar la contraseña antes de guardarla
    $contrasena = password_hash($contrasena, PASSWORD_BCRYPT);

    // Datos adicionales
    $tabaco = $_POST['tabaco'];
    $cantidad = $_POST['cantidad'];
    $dejar = $_POST['dejar'];
    $apoyo = $_POST['apoyo'];
    $razon = $_POST['razon'];
    $actividades = $_POST['actividades'];
    $salud = $_POST['salud'];

    // Insertar datos en la base de datos
    $sql = "INSERT INTO usuarios (nombre, edad, email, contrasena, tabaco, cantidad, dejar, apoyo, razon, actividades, salud)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisssisssss", $nombre, $edad, $email, $contrasena, $tabaco, $cantidad, $dejar, $apoyo, $razon, $actividades, $salud);

    if ($stmt->execute()) {
        session_start(); // Iniciar la sesión
        $_SESSION['usuario'] = $nombre; // Guardar el nombre en la sesión
        header("Location: ../vistas/login.php"); // Redirigir al login
        exit();
    } else {
        // Si ocurre un error en la inserción
        header("Location: ../vistas/registro.php?error=Error al registrar el usuario");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>