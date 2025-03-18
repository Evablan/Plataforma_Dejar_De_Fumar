<?php
// /lib/GestionSesiones.php

class GestionSesiones {
    // Iniciar sesión
    public function iniciarSesion($usuario) {
        session_start();
        $_SESSION['usuario'] = $usuario;
    }

    // Verificar si el usuario está autenticado
    public function verificarSesion() {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header("Location: login.php"); // Redirige al login si no está logueado
            exit();
        }
    }

    // Cerrar sesión
    public function cerrarSesion() {
        session_start();
        session_destroy();
        header("Location: login.php"); // Redirige a login tras cerrar sesión
        exit();
    }
}
?>