<?php
session_start();
session_destroy(); // Destruir todas las sesiones
header("Location: ../vistas/login.php"); // Redirigir al login
exit();
?>