<?php
session_start(); // Iniciar sesión
require_once '../modelos/config.php'; // Asegúrate de que la ruta es correcta

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura de datos del formulario
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    // Verificar si el email existe en la base de datos
    $sql = "SELECT id, nombre, contrasena FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Si el usuario existe, verificar la contraseña
        $usuario = $result->fetch_assoc();
        if (password_verify($contrasena, $usuario['contrasena'])) {
            // ✅ Guardar datos en la sesión
            $_SESSION['id_usuario'] = $usuario['id']; // Guardar ID del usuario en sesión
            $_SESSION['usuario'] = $usuario['nombre']; // Guardar el nombre del usuario en sesión
            
            header("Location: ../vistas/dashboard.php"); // Redirigir al dashboard
            exit();
        } else {
            // Contraseña incorrecta
            header("Location: ../vistas/login.php?error=Credenciales incorrectas");
            exit();
        }
    } else {
        // Si no existe el usuario
        header("Location: ../vistas/login.php?error=Credenciales incorrectas");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
