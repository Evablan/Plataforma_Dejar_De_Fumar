<?php
require_once '../modelos/config.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    $confirmContrasena = $_POST['confirmContrasena'];

    if ($contrasena !== $confirmContrasena) {
        header("Location: ../vistas/registro.php?error=Las contraseñas no coinciden");
        exit();
    }

    $sql_check = "SELECT id FROM usuarios WHERE email = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        header("Location: ../vistas/registro.php?error=El correo electrónico ya está registrado");
        exit();
    }
    $stmt_check->close();

    $contrasena = password_hash($contrasena, PASSWORD_BCRYPT);

    $tabaco = $_POST['tabaco'];
    $cantidad = $_POST['cantidad'];
    $dejar = $_POST['dejar'];
    $apoyo = $_POST['apoyo'];
    $razon = $_POST['razon'];
    $actividades = $_POST['actividades'];
    $salud = $_POST['salud'];

    $sql = "INSERT INTO usuarios (nombre, edad, email, contrasena, tabaco, cantidad, dejar, apoyo, razon, actividades, salud)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisssisssss", $nombre, $edad, $email, $contrasena, $tabaco, $cantidad, $dejar, $apoyo, $razon, $actividades, $salud);

    if ($stmt->execute()) {
       
        session_start(); 
        $_SESSION['usuario'] = $nombre; 
        $_SESSION['usuario_id'] = $usuario_id;
        header("Location: ../vistas/login.php"); 
        exit();
    } else {
        header("Location: ../vistas/registro.php?error=Error al registrar el usuario");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>