<?php

use PHPUnit\Framework\TestCase;

class DashboardRedirectionTest extends TestCase
{
    public function testForoLinkExists()
    {
        // Simulamos que el usuario está logueado
        $_SESSION['nombre'] = 'angel';
        $_SESSION['id'] = 1;

        // Capturamos la salida del archivo dashboard.php
        ob_start();
        include 'D:/xampp/htdocs/Plataforma_Dejar_De_Fumar/dashboard.php';
        $output = ob_get_clean();

        // Comprobamos que el enlace al foro existe
        $this->assertStringContainsString('href="foro.php"', $output, "El botón Foro debería redirigir a foro.php");
    }
}
