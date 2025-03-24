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
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        if (password_verify($contrasena, $usuario['contrasena'])) {
            $_SESSION['id_usuario'] = $usuario['id']; 
            $_SESSION['usuario'] = $usuario['nombre']; 
            
            header("Location: ../vistas/dashboard.php"); 
            exit();
        } else {
            header("Location: ../vistas/login.php?error=Credenciales incorrectas");
            exit();
        }
    } else {
        header("Location: ../vistas/login.php?error=Credenciales incorrectas");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
