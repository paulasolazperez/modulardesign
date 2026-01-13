<?php
require("conexion.php");

$sql = "SELECT * FROM vinilos WHERE visible = 1";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/estilos.css">
    <title>Catálogo</title>
</head>
<body>

<header class="header-inicio">
  <div class="logo">
    <a href="index.html">
      <img src="images/logo.png" alt="Logo">
    </a>
  </div>

  <button class="hamburger-btn" id="hamburger-btn">☰</button>

  <nav class="menu-lateral" id="menu-lateral">
    <ul>
      <li><a href="index.html">Inicio</a></li>
      <li><a href="catalogo.php">Catálogo</a></li>
      <li><a href="nosotros.html">Nosotros</a></li>
      <li><a href="#contacto">Contacto</a></li>
      <a href="login.php" class="boton-descubre">Gestión catálogo</a>
    </ul>
  </nav>
</header>

<main class="catalogo">

<?php if ($resultado->num_rows > 0): ?>
    <?php while ($vinilo = $resultado->fetch_assoc()): ?>

        <div class="vinilo-card">
            <!-- 🔑 CLAVE: uploads + nombre del archivo -->
            <img src="images/<?php echo $vinilo['foto']; ?>"
                 alt="<?php echo htmlspecialchars($vinilo['nom_vinilo']); ?>">

            <h3><?php echo htmlspecialchars($vinilo['nom_vinilo']); ?></h3>
            <p><?php echo htmlspecialchars($vinilo['nom_artista']); ?></p>
            <p><?php echo htmlspecialchars($vinilo['descripcion']); ?></p>
            <span class="precio">
                <?php echo number_format($vinilo['precio'], 2); ?> €
            </span>
        </div>

    <?php endwhile; ?>
<?php else: ?>
    <p>No hay vinilos disponibles.</p>
<?php endif; ?>

</main>

</body>
</html>