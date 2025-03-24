<?php
session_start();
require_once '../modelos/config.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    $sql = "SELECT id, nombre, contrasena FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        if (password_verify($contrasena, $usuario['contrasena'])) {
            $_SESSION['usuario'] = $usuario['nombre']; 
            $_SESSION['id_usuario'] = $usuario['id']; 
            header("Location: ../vistas/dashboard.php"); 
            exit();
        } else {
            header("Location: ../vistas/login.php?error=Contraseña incorrecta");
            exit();
        }
    } else {
        header("Location: ../vistas/login.php?error=Usuario no encontrado");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>