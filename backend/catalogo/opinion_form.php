<?php
require "../conexion.php";

$id_vinilo = $_GET['id'] ?? null;
if (!$id_vinilo) exit("Vinilo no válido");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dejar opinión</title>
</head>
<body>

<h2>Tu opinión</h2>

<form action="guardar_opinion.php" method="POST">
    <input type="hidden" name="id_vinilo" value="<?= $id_vinilo ?>">

    <label>Nombre</label><br>
    <input type="text" name="nombre" required><br><br>

    <label>Ciudad</label><br>
    <input type="text" name="ciudad" required><br><br>

    <label>Comentario</label><br>
    <textarea name="comentario" required></textarea><br><br>

    <button type="submit">Enviar opinión</button>
</form>

</body>
</html>