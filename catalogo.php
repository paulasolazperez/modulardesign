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

    <h2>Nuestro catálogo de vinilos</h2>

    <?php if ($resultado->num_rows > 0): ?>
        <?php while ($vinilo = $resultado->fetch_assoc()): ?>

            <article class="vinilo">

                <!-- Imagen -->
                <img
                    class="vinilo-imagen"
                    src="images/images_vinilos/<?php echo htmlspecialchars($vinilo['foto']); ?>"
                    alt="<?php echo htmlspecialchars($vinilo['nom_vinilo']); ?>"
                >

                <!-- Info -->
                <div class="vinilo-info">
                    <h3 class="vinilo-titulo">
                        <?php echo htmlspecialchars($vinilo['nom_vinilo']); ?>
                    </h3>

                    <p class="vinilo-descripcion">
                        <strong><?php echo htmlspecialchars($vinilo['nom_artista']); ?></strong><br><br>
                        <?php echo htmlspecialchars($vinilo['descripcion']); ?>
                    </p>

                    <span class="vinilo-precio">
                        <?php echo number_format($vinilo['precio'], 2); ?> €
                    </span>

                    <div style="margin-top:2rem;">
                        <a href="#" class="boton-descubre">
                            Ver vinilo
                        </a>
                    </div>
                </div>

            </article>

        <?php endwhile; ?>
    <?php else: ?>
        <p>No hay vinilos disponibles.</p>
    <?php endif; ?>

</main>
<script src="menu_hamburgesa.js"></script>
</body>
</html>