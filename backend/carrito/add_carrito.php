<?php
session_start();
require("../conexion.php");

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM vinilos WHERE id_vinilo = $id");
$vinilo = $result->fetch_assoc();

if (!isset($_SESSION['carrito'][$id])) {
    $_SESSION['carrito'][$id] = [
        'id' => $vinilo['id_vinilo'],
        'nombre' => $vinilo['nom_vinilo'],
        'descripcion' => $vinilo['descripcion'], // 🔑 ESTA LÍNEA
        'precio' => $vinilo['precio'],
        'foto' => $vinilo['foto'],
        'cantidad' => 1
    ];
} else {
    $_SESSION['carrito'][$id]['cantidad']++;
}

header("Location: carrito.php");
exit;