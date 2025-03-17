<<<<<<< HEAD
<?php 
require_once '../modelos/config.php'; // Asegúrate de que la ruta es correcta

=======
?>


>>>>>>> 436c71b (Restaurando el repositorio)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $email = $_POST['email'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT);
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
<<<<<<< HEAD
        session_start(); // Iniciar la sesión
        $_SESSION['usuario'] = $nombre; // Guardar el nombre en la sesión
    
=======
        session_start();
        $_SESSION['usuario'] = $nombre; // Guardar el nombre en la sesión
>>>>>>> 436c71b (Restaurando el repositorio)
        header("Location: ../vistas/login.php"); // Redirigir al login
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
<<<<<<< HEAD
} 
?>
=======
}
>>>>>>> 436c71b (Restaurando el repositorio)
