<?php
header('Content-Type: application/json');
require_once '../modelos/config.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data["usuario_id"]) && isset($data["ahorro_diario"])) {
        $usuario_id = intval($data["usuario_id"]);
        $ahorro_diario = floatval($data["ahorro_diario"]);
        $fecha = date("Y-m-d");

        $sql = "INSERT INTO ahorros (usuario_id, fecha, ahorro_diario) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isd", $usuario_id, $fecha, $ahorro_diario);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo json_encode(["status" => "success", "message" => "Ahorro guardado"]);
        } else {
            echo json_encode(["status" => "error", "message" => "No se pudo guardar"]);
        }

        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Datos incompletos"]);
    }
}
?>
