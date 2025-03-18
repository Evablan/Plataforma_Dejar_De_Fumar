<?php
// /modelos/Usuario.php

class Usuario {
    public function verificarCredenciales($email, $contrasena) {
        // Aquí puedes hacer la consulta a la base de datos para verificar las credenciales
        // Por ejemplo, vamos a simular que el email y la contraseña son correctos

        $usuarios = [
            'test@example.com' => '123456',
        ];

        if (isset($usuarios[$email]) && $usuarios[$email] == $contrasena) {
            return true;
        }

        return false;
    }
}
?>