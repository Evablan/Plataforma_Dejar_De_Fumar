<?php
session_start();
require_once "../modelos/Pregunta.php";

$preguntaModelo = new Pregunta();
$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST as $campo => $respuesta) {
        if (strpos($campo, 'pregunta') === 0 && !empty($respuesta)) { 
            $pregunta = str_replace('_', ' ', $campo); 
            $preguntaModelo->guardarRespuesta($usuario, $pregunta, $respuesta);
        }
    }
    header("Location: ../vistas/historial_respuestas.php");
    exit();
} else {
    echo "Debe completar todos los campos.";
}
?>
