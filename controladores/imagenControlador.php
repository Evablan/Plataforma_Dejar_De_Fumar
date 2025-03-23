<?php
session_start();
require_once "../modelos/config.php";
require_once "../modelos/img.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['imagen'])) {
    $id_usuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null;

    if (!$id_usuario) {
        die("Error: Usuario no autenticado.");
    }

    $archivo = $_FILES['imagen'];
    $nombreArchivo = basename($archivo['name']);
    $rutaCarpeta = __DIR__ . "/../uploads/"; // Ruta absoluta a la carpeta uploads
    $rutaDestino = $rutaCarpeta . $nombreArchivo;

    // 🔹 Verificar que la carpeta uploads/ existe y es escribible
    if (!is_dir($rutaCarpeta)) {
        mkdir($rutaCarpeta, 0777, true);
    }

    // 🔹 Mover el archivo a la carpeta
    if (move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {
        // Guardar en la base de datos
        $imagenModel = new Imagen($conn);
        if ($imagenModel->subirImagen($id_usuario, $nombreArchivo, "uploads/" . $nombreArchivo)) {
            header("Location: ../vistas/blog.php?mensaje=Imagen subida correctamente");
            exit();
        } else {
            echo "Error al guardar en la base de datos.";
        }
    } else {
        echo "Error al mover el archivo. Código de error: " . $_FILES['imagen']['error'];
    }
} else {
    echo "No se ha subido ninguna imagen.";
}
?>
