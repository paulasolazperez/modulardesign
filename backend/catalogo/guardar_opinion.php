<?php
require "../conexion.php";

$stmt = $conn->prepare("
    INSERT INTO opiniones (id_vinilo, nombre, ciudad, comentario)
    VALUES (?, ?, ?, ?)
");

$stmt->bind_param(
    "isss",
    $_POST['id_vinilo'],
    $_POST['nombre'],
    $_POST['ciudad'],
    $_POST['comentario']
);

$stmt->execute();

header("Location: catalogo.php");
exit;