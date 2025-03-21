<?php
session_start();
require_once '../modelos/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['id_usuario'])) {
    $id_usuario = $_SESSION['id_usuario'];
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];

    $sql = "INSERT INTO posts (id_usuario, titulo, contenido, fecha) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $id_usuario, $titulo, $contenido);

    if ($stmt->execute()) {
        header("Location: blog.php");
        exit();
    } else {
        header("Location: blog.php?error=No se pudo guardar el post");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: login.php");
    exit();
}
?>
