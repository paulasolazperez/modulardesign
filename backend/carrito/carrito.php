<?php
session_start();
$carrito = $_SESSION['carrito'] ?? [];
$total = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Carrito</title>
<link rel="stylesheet" href="../../frontend/css/estilos/estilos.css">
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
      <li><a href="../catalogo/catalogo.php">Catálogo</a></li>
      <li><a href="../../frontend/nosotros.html">Nosotros</a></li>
      <li><a href="#contacto">Contacto</a></li>
      <a href="../auth/login.php" class="boton-descubre">Gestión catálogo</a>
    </ul>
  </nav>
</header>

<main class="carrito-layout">

    <h2 class="carrito-titulo">Tu carrito</h2>

    <div class="carrito-contenido">

        <!-- LISTA IZQUIERDA -->
        <section class="carrito-lista">

        <?php if (empty($carrito)): ?>
            <p>El carrito está vacío</p>
        <?php else: ?>

            <?php foreach ($carrito as $item): ?>
                <?php
                    $subtotal = $item['precio'] * $item['cantidad'];
                    $total += $subtotal;
                ?>

                <article class="carrito-card">

                    <img class="carrito-img"
                         src="../../frontend/img/images_vinilos/<?php echo htmlspecialchars($item['foto']); ?>"
                         alt="<?php echo htmlspecialchars($item['nombre']); ?>">

                    <div class="carrito-card-info">
                        <h3><?php echo htmlspecialchars($item['nombre']); ?></h3>

                        <p class="carrito-descripcion">
                            <?php echo htmlspecialchars($item['descripcion']); ?>
                        </p>

                        <span class="carrito-cantidad">
                            Cantidad: x<?php echo $item['cantidad']; ?>
                        </span>

                        <a href="remove_carrito.php?id=<?php echo $item['id']; ?>"
                           class="carrito-eliminar">
                           Quitar
                        </a>
                    </div>

                    <div class="carrito-precio-derecha">
                        <?php echo number_format($subtotal, 2); ?> €
                    </div>

                </article>

            <?php endforeach; ?>

        <?php endif; ?>

        </section>

        <!-- RESUMEN DERECHA -->
        <aside class="carrito-resumen">
            <h3>Total: <?php echo number_format($total, 2); ?> €</h3>

            <a href="../catalogo/catalogo.php" class="boton-descubre">
                Seguir comprando
            </a>
        </aside>

    </div>

</main>

<script src="../menu_hamburgesa.js"></script>
</body>
</html>