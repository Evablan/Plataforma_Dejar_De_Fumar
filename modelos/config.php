<?php
$servidor = "localhost";
$usuario = "root";
$clave = ""; // En XAMPP, la contraseña está vacía
$base_datos = "plataforma";

// Crear conexión
$conn = new mysqli($servidor, $usuario, $clave, $base_datos);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>