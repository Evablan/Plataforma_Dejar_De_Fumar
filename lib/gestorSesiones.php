<?php
class GestionSesiones {
    
    public function iniciarSesion($usuario) {
        session_start();
        $_SESSION['usuario'] = $usuario;
    }

    
    public function verificarSesion() {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header("Location: login.php"); 
            exit();
        }
    }

    public function cerrarSesion() {
        session_start();
        session_destroy();
        header("Location: login.php"); 
        exit();
    }
}
?>