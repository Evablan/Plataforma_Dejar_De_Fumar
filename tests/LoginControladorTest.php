<?php

use PHPUnit\Framework\TestCase;

class LoginControladorTest extends TestCase
{
    public function testLoginConCredencialesIncorrectas()
    {
        // Simula enviar el formulario con credenciales incorrectas
        $_POST['email'] = 'usuario_inexistente@dominio.com';
        $_POST['contrasena'] = 'contrasenaIncorrecta';

        // Incluye el controlador de login que se ejecutará con estos valores
        $redireccion = null;
        ob_start();  // Comienza a capturar la salida
        include_once __DIR__ . '/../controladores/loginControlador.php';  // Ejecuta el script PHP
        $redireccion = ob_get_clean();  // Captura la salida de la redirección

        // Verifica que la URL contiene el error de "Credenciales incorrectas"
        $this->assertStringContainsString('Credenciales incorrectas', $redireccion);
    }
}
?>