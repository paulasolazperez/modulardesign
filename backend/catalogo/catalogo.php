<?php
require "../conexion.php";

$sql = "SELECT * FROM vinilos WHERE visible = 1";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="../../frontend/css/estilos/estilos.css">

    <title>Catálogo</title>
</head>
<body>

<header class="header-inicio">
    <div class="logo">
        <a href="../../frontend/index.html">
            <img src="../../frontend/img/logo.png" alt="Logo">
        </a>
    </div>

    <button class="hamburger-btn" id="hamburger-btn">☰</button>

    <nav class="menu-lateral" id="menu-lateral">
        <ul>
            <li><a href="../../frontend/index.html">Inicio</a></li>
            <li><a href="catalogo.php">Catálogo</a></li>
            <li><a href="../../frontend/nosotros.html">Nosotros</a></li>
            <li><a href="#contacto">Contacto</a></li>
            <a href="../backend/auth/login.php" class="boton-descubre">Gestión catálogo</a>
        </ul>
    </nav>
</header>

<main class="catalogo">

    <h2>Nuestro catálogo de vinilos</h2>

    <?php if ($resultado->num_rows > 0): ?>
        <?php while ($vinilo = $resultado->fetch_assoc()): ?>

            <article class="vinilo catalogo-vinilo">

                <img
                    class="vinilo-imagen"
                    src="../../frontend/img/images_vinilos/<?= htmlspecialchars($vinilo['foto']) ?>"
                    alt="<?= htmlspecialchars($vinilo['nom_vinilo']) ?>"
                >

                <div class="vinilo-info">
                    <h3 class="vinilo-titulo">
                        <?= htmlspecialchars($vinilo['nom_vinilo']) ?>
                    </h3>

                    <p class="vinilo-descripcion">
                        <strong><?= htmlspecialchars($vinilo['nom_artista']) ?></strong><br><br>
                        <?= htmlspecialchars($vinilo['descripcion']) ?>
                    </p>

                    <span class="vinilo-precio">
                        <?= number_format($vinilo['precio'], 2) ?> €
                    </span>

                    <div style="margin-top:2rem;">
                        <a href="../carrito/add_carrito.php?id=<?= $vinilo['id_vinilo'] ?>"
                           class="boton-descubre">
                           Añadir al carrito
                        </a>
                    </div>
                </div>

            </article>

        <?php endwhile; ?>
    <?php else: ?>
        <p>No hay vinilos disponibles.</p>
    <?php endif; ?>

</main>
<footer class="footer">

  <!-- Zona superior: valoración -->
  <div class="footer-rating-top">
    <h3 class="footer-subtitle">Valora nuestra página</h3>
    <div class="footer-line"></div>
    <p class="rating-label">Tu opinión nos ayuda a mejorar:</p>

    <div class="stars">
      <i class="fas fa-star" data-value="1"></i>
      <i class="fas fa-star" data-value="2"></i>
      <i class="fas fa-star" data-value="3"></i>
      <i class="fas fa-star" data-value="4"></i>
      <i class="fas fa-star" data-value="5"></i>
    </div>

    <textarea class="rating-text" placeholder="Escribe tu opinión..." rows="2"></textarea>
    <button class="footer-button rating-submit">Enviar valoración</button>
  </div>

  <div class="footer-divider"></div>

  <div class="footer-container">

    <!-- Columna 1 -->
    <div class="footer-section">
      <h2 class="footer-title">Chocolate Vinyls</h2>
      <div class="footer-line"></div>
      <p class="footer-description">
        Vinilos únicos y ediciones especiales — sonido con alma.
      </p>

      <div class="social-links">
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-spotify"></i></a>
        <a href="#"><i class="fab fa-facebook"></i></a>
        <a href="#"><i class="fab fa-youtube"></i></a>
      </div>

      <div class="footer-bottom">
        © 2025 <span>Chocolate Vinyls</span>. Diseñado con 🎧 por
        <strong>Modular Design</strong>.
      </div>
    </div>

    <!-- Columna 2 -->
    <div class="footer-section">
      <h3 class="footer-subtitle">Navegación</h3>
      <div class="footer-line"></div>
      <ul class="footer-links">
        <li><a href="#index">Inicio</a></li>
        <li><a href="#catalogo">Catálogo</a></li>
        <li><a href="nosotros.html">Nosotros</a></li>
        <li><a href="#historia">Historia</a></li>
        <li><a href="#contacto">Contacto</a></li>
      </ul>
    </div>

    <!-- Columna 3 -->
    <div class="footer-section">
      <h3 class="footer-subtitle">Suscríbete</h3>
      <div class="footer-line"></div>
      <p class="footer-description">
        Recibe novedades y lanzamientos exclusivos.
      </p>
      <form class="footer-form" onsubmit="return false;">
        <input type="email" class="footer-input"
               placeholder="Tu correo electrónico" required>
        <button type="submit" class="footer-button">Suscribirme</button>
      </form>
    </div>

  </div>
</footer>
<script src="../menu_hamburgesa.js"></script>
</body>
</html>