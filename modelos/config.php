<?php
$servidor = "127.0.0.1";
$usuario = "root";
$clave = ""; 
$base_datos = "plataforma";

$conn = new mysqli($servidor, $usuario, $clave, $base_datos);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>