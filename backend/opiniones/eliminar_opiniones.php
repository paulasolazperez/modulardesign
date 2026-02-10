<?php
header("Content-Type: application/json; charset=UTF-8");

require_once("../conexion.php");

try {

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode(["error" => "Método no permitido"]);
        exit;
    }

    if (!isset($_POST['id_opinion'])) {
        http_response_code(400);
        echo json_encode(["error" => "ID de opinión requerido"]);
        exit;
    }

    $id_opinion = intval($_POST['id_opinion']);

    // Verificar existencia
    $check = $conexion->prepare("SELECT id_opinion FROM opiniones WHERE id_opinion = ?");
    $check->bind_param("i", $id_opinion);
    $check->execute();
    $res = $check->get_result();

    if ($res->num_rows === 0) {
        echo json_encode([
            "exito" => false,
            "mensaje" => "La opinión no existe"
        ]);
        exit;
    }

    $stmt = $conexion->prepare("DELETE FROM opiniones WHERE id_opinion = ?");
    $stmt->bind_param("i", $id_opinion);

    if ($stmt->execute()) {
        echo json_encode([
            "exito" => true,
            "mensaje" => "Opinión eliminada correctamente"
        ]);
    } else {
        echo json_encode([
            "exito" => false,
            "mensaje" => "No se pudo eliminar la opinión"
        ]);
    }

    $stmt->close();
    $conexion->close();

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        "exito" => false,
        "error" => "Error interno del servidor"
    ]);
}
?>
