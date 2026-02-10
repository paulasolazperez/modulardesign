<?php
header("Content-Type: application/json; charset=UTF-8");

require_once("../conexion.php");

try {

    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        http_response_code(405);
        echo json_encode(["error" => "Método no permitido"]);
        exit;
    }

    $id_vinilo = isset($_GET['id_vinilo']) ? intval($_GET['id_vinilo']) : null;
    $ciudad = isset($_GET['ciudad']) ? trim($_GET['ciudad']) : null;

    $sql = "SELECT o.*, v.titulo AS titulo_vinilo
            FROM opiniones o
            INNER JOIN vinilos v ON o.id_vinilo = v.id_vinilo
            WHERE 1=1";

    $parametros = [];
    $tipos = "";

    if (!empty($id_vinilo)) {
        $sql .= " AND o.id_vinilo = ?";
        $parametros[] = $id_vinilo;
        $tipos .= "i";
    }

    if (!empty($ciudad)) {
        $sql .= " AND o.ciudad = ?";
        $parametros[] = $ciudad;
        $tipos .= "s";
    }

    $stmt = $conexion->prepare($sql);

    if (!empty($parametros)) {
        $stmt->bind_param($tipos, ...$parametros);
    }

    $stmt->execute();
    $resultado = $stmt->get_result();

    $opiniones = [];

    while ($fila = $resultado->fetch_assoc()) {
        $opiniones[] = $fila;
    }

    echo json_encode([
        "exito" => true,
        "total" => count($opiniones),
        "datos" => $opiniones
    ]);

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
