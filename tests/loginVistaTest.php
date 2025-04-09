<?php
use PHPUnit\Framework\TestCase;

class LoginVistaTest extends TestCase
{
    public function testContieneFormularioLogin()
    {
        ob_start();
        include __DIR__ . '/../vistas/login.php';
        $output = ob_get_clean();

        $this->assertStringContainsString('<form action="../controladores/loginControlador.php" method="POST">', $output);
        $this->assertStringContainsString('input type="email"', $output);
        $this->assertStringContainsString('input type="password"', $output);
        $this->assertStringContainsString('Iniciar sesión', $output);
    }
}
?>
