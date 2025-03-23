<?php

class Usuario {
    public function verificarCredenciales($email, $contrasena) {
        

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