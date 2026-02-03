<?php
require "../conexion.php";
session_start();

/* ===================== AÑADIR VINILO ===================== */
if (isset($_POST['add_vinilo'])) {

    // Guardar imagen
    $nombreFoto = basename($_FILES['foto']['name']);
    $rutaDestino = __DIR__ . "../img/images_vinilos/" . $nombreFoto;

    move_uploaded_file($_FILES['foto']['tmp_name'], $rutaDestino);
    $foto = $nombreFoto;

    $nom_vinilo  = $_POST['nom_vinilo'];
    $nom_artista = $_POST['nom_artista'];
    $descripcion = $_POST['descripcion'];
    $precio      = $_POST['precio'];
    $año         = $_POST['año'];

    $sql = "INSERT INTO vinilos (foto, nom_vinilo, nom_artista, descripcion, precio, `año`)
            VALUES ('$foto', '$nom_vinilo', '$nom_artista', '$descripcion', '$precio', '$año')";

    $conn->query($sql);
}

/* ===================== BORRAR VINILO ===================== */
if (isset($_GET['borrar'])) {
    $id = $_GET['borrar'];
    $conn->query("DELETE FROM vinilos WHERE id_vinilo=$id");
}

/* ===================== MOSTRAR / OCULTAR ===================== */
if (isset($_GET['toggle'])) {
    $id     = $_GET['toggle'];
    $estado = $_GET['estado']; // 1 o 0
    $conn->query("UPDATE vinilos SET visible=$estado WHERE id_vinilo=$id");
}

/* ===================== BUSCAR VINILO ===================== */
if (isset($_POST['buscar_btn'])) {
    $buscar  = $_POST['buscar'];
    $vinilos = $conn->query("SELECT * FROM vinilos WHERE nom_vinilo LIKE '%$buscar%'");
} else {
    $vinilos = $conn->query("SELECT * FROM vinilos");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Gestor de Vinilos</title>

<style>
body { font-family: Arial; margin: 20px; }
form { margin-bottom: 40px; padding: 15px; border: 1px solid #ccc; }
table { width: 100%; border-collapse: collapse; margin-top: 20px; }
th, td { padding: 8px; border: 1px solid #ccc; text-align: center; }
img { width: 60px; height: 60px; object-fit: cover; }
input, textarea { width: 90%; padding: 7px; margin-top: 5px; }
button { padding: 6px 12px; cursor: pointer; }

.home-icon {
    position: fixed;
    top: 20px;
    right: 20px;
    font-size: 26px;
    text-decoration: none;
    color: #000;
    background: #f0f0f0;
    padding: 8px 12px;
    border-radius: 50%;
    border: 1px solid #ccc;
}
.home-icon:hover {
    background: #ddd;
}
</style>
</head>

<body>

<a href="https://modulardesign.vercel.app" class="home-icon" title="Volver al inicio">🏠</a>

<h1>Gestor de Vinilos</h1>

<!-- ===================== FORMULARIO AÑADIR ===================== -->
<h2>Añadir nuevo vinilo</h2>
<form method="POST" enctype="multipart/form-data">

    <label>Foto:</label><br>
    <input type="file" name="foto" required><br><br>

    <label>Nombre del vinilo:</label><br>
    <input type="text" name="nom_vinilo" required><br><br>

    <label>Artista:</label><br>
    <input type="text" name="nom_artista" required><br><br>

    <label>Descripción:</label><br>
    <textarea name="descripcion" required></textarea><br><br>

    <label>Precio (€):</label><br>
    <input type="number" step="0.01" name="precio" required><br><br>

    <label>Año:</label><br>
    <input type="date" name="año" required><br><br>

    <button type="submit" name="add_vinilo">Añadir vinilo</button>
</form>

<!-- ===================== BUSCADOR ===================== -->
<h2>Buscar vinilo por nombre</h2>
<form method="POST">
    <input type="text" name="buscar" placeholder="Introduce nombre del vinilo">
    <button type="submit" name="buscar_btn">Buscar</button>
</form>

<!-- ===================== TABLA ===================== -->
<h2>Listado de vinilos</h2>

<table>
<tr>
    <th>Foto</th>
    <th>Nombre</th>
    <th>Artista</th>
    <th>Descripción</th>
    <th>Precio</th>
    <th>Año</th>
    <th>Visible</th>
    <th>Acciones</th>
</tr>

<?php while ($v = $vinilos->fetch_assoc()) { ?>
<tr>
    <td>
        <img src="../img/images_vinilos/<?= htmlspecialchars($vinilo['foto']) ?>">
    </td>
    <td><?= $v['nom_vinilo'] ?></td>
    <td><?= $v['nom_artista'] ?></td>
    <td><?= $v['descripcion'] ?></td>
    <td><?= $v['precio'] ?> €</td>
    <td><?= $v['año'] ?></td>

    <td>
        <?= $v['visible'] ? "Sí" : "No" ?><br>
        <a href="gestor.php?toggle=<?= $v['id_vinilo'] ?>&estado=<?= $v['visible'] ? 0 : 1 ?>">
            <?= $v['visible'] ? "Ocultar" : "Mostrar" ?>
        </a>
    </td>

    <td>
        <a href="gestor.php?borrar=<?= $v['id_vinilo'] ?>"
           onclick="return confirm('¿Seguro que deseas borrar este vinilo?')">
           Borrar
        </a>
    </td>
</tr>
<?php } ?>

</table>

</body>
</html>