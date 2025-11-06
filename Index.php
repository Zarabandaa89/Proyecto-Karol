<?php
session_start();
include "includes/conexion.php";
?>
<?php if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'cuenta_eliminada'): ?>
  <script>alert("Tu cuenta ha sido eliminada correctamente.");</script>
<?php endif; ?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página Principal | Chic Royale</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="css/index.css">
</head>

<body>
  <header>
    <div class="barra-superior">
      <div class="logo">
        <div class="logo-icon">💄</div>
        <a href="index.php">Chic Royale</a>
      </div>

      <nav class="menu">
        <a href="#" onclick="scrollToTop(); return false;">Inicio</a>
        <a href="productos.php">Productos</a>
        <a href="mision.php">Misión</a>
        <a href="vision.php">Visión</a>
      </nav>

      <div class="iconos">
        

        <button class="icon-btn" id="cartToggle">
          <i class="fa-solid fa-cart-shopping"></i>
          <span class="cart-badge" id="cartCount">0</span>
        </button>

       <div class="user-menu">
  <div class="user-toggle" id="userToggle">
    <i class="fa-solid fa-user"></i>
  </div>

  <div class="dropdown-menu" id="dropdownMenu">
    <?php if (isset($_SESSION['usuario_id'])): ?>
      <!-- Si el usuario ha iniciado sesión -->
      <div class="user-profile active" id="userProfile">
        <div class="dropdown-header">
          <i class="fa-solid fa-user-circle"></i>
          <h3><?= htmlspecialchars($_SESSION['usuario_nombre']); ?></h3>
          <p><?= htmlspecialchars($_SESSION['usuario_email']); ?></p>
        </div>

        <div class="dropdown-links">
          <a href="perfil.php"><i class="fa-solid fa-user"></i><span>Mi Perfil</span></a>
          <a href="pedidos.php"><i class="fa-solid fa-box"></i><span>Mis Pedidos</span></a>
          <a href="favoritos.php"><i class="fa-solid fa-heart"></i><span>Favoritos</span></a>
          <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i><span>Cerrar Sesión</span></a>
        </div>
      </div>
    <?php else: ?>
      <!-- Si NO hay sesión -->
      <div class="guest-links" id="guestLinks">
        <div class="dropdown-header">
          <i class="fa-solid fa-user-circle"></i>
          <h3>Bienvenido</h3>
          <p>Inicia sesión o regístrate</p>
        </div>

        <div class="dropdown-links">
          <a href="login.php"><i class="fa-solid fa-right-to-bracket"></i><span>Iniciar Sesión</span></a>
          <a href="Registro.php"><i class="fa-solid fa-user-plus"></i><span>Registrarse</span></a>
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>
      </div>
    </div>
  </header>

  <section class="productos-container">
    <div class="productos-grid" id="productosGrid"></div>
  </section>

  <div class="cart-overlay" id="cartOverlay"></div>

  <aside class="cart-sidebar" id="cartSidebar">
    <div class="cart-header">
      <h2><i class="fa-solid fa-shopping-bag"></i> Mi Carrito</h2>
      <button class="close-cart" id="closeCart"><i class="fa-solid fa-times"></i></button>
    </div>

    <div class="cart-items" id="cartItems">
      <div class="cart-empty">
        <i class="fa-solid fa-shopping-cart"></i>
        <p>Tu carrito está vacío</p>
      </div>
    </div>

    <div class="cart-footer">
      <div class="cart-total">
        <span>Total:</span>
        <span id="cartTotal">$0</span>
      </div>
      <button class="checkout-btn" id="checkoutBtn">
        <i class="fa-solid fa-credit-card"></i> Proceder al Pago
      </button>
    </div>
  </aside>

  <section class="hero-banner">
    <div class="floating-elements">
      <span>💄</span>
      <span>💋</span>
      <span>✨</span>
      <span>👑</span>
    </div>

    <div class="hero-content">
      <h1>Nueva Colección 2025</h1>
      <p>Descubre la belleza que hay en ti con nuestros productos premium</p>
      <a href="productos.php" class="hero-btn">
        <i class="fa-solid fa-shopping-bag"></i> Comprar Ahora
      </a>
    </div>
  </section>

  <section class="categorias-section">
    <h2 class="titulo-categorias">💄 Elige una categoría 💋</h2>
    <div class="categorias">
      <div class="categoria">
        <div class="categoria-imagen"> <img src="imagenes/Labios.png" alt="Labios" onerror="this.parentElement.innerHTML='<i class=\'fa-solid fa-lips\' style=\'font-size:80px;color:#ff69b4;\'></i>'"> </div>
        <p>Labios</p>
      </div>
      <div class="categoria">
        <div class="categoria-imagen"> <img src="imagenes/Ojos.png" alt="Ojos" onerror="this.parentElement.innerHTML='<i class=\'fa-solid fa-eye\' style=\'font-size:80px;color:#ff69b4;\'></i>'"> </div>
        <p>Ojos</p>
      </div>
      <div class="categoria">
        <div class="categoria-imagen"> <img src="imagenes/Piel.png" alt="Piel" onerror="this.parentElement.innerHTML='<i class=\'fa-solid fa-spa\' style=\'font-size:80px;color:#ff69b4;\'></i>'"> </div>
        <p>Piel</p>
      </div>
      <div class="categoria">
        <div class="categoria-imagen"> <img src="imagenes/Mejillas.png" alt="Mejillas" onerror="this.parentElement.innerHTML='<i class=\'fa-solid fa-face-smile\' style=\'font-size:80px;color:#ff69b4;\'></i>'"> </div>
        <p>Mejillas</p>
      </div>
    </div>
  </section>

  <section class="destacados">
    <h2>✨ Productos Destacados ✨</h2>

    <div class="productos-grid">
      <?php
      $sqlDest = "SELECT * FROM productos_1 WHERE destacado = 1";
      $destacados = $conn->query($sqlDest);

      if ($destacados->num_rows > 0) {
        while ($p = $destacados->fetch_assoc()) {
          echo '
          <div class="producto">
            <div class="producto-imagen">
              <img src="uploads/' . $p['imagen'] . '" alt="' . $p['nombre_producto'] . '">
            </div>

            <h3>' . $p['nombre_producto'] . '</h3>
            <p class="producto-precio">$' . number_format($p['precio'], 0, ',', '.') . '</p>

            <button class="producto-btn add-to-cart" data-id="' . $p['id'] . '">
              <i class="fa-solid fa-cart-plus"></i> Agregar
            </button>
          </div>';
        }
      } else {
        echo "<p>No hay productos destacados disponibles ✨</p>";
      }
      ?>
    </div>
  </section>

  <footer>
    © 2025 Chic Royale - Todos los derechos reservados 💄
  </footer>

  <script>
    const userToggle = document.getElementById("userToggle");
    const dropdownMenu = document.getElementById("dropdownMenu");
    const guestLinks = document.getElementById("guestLinks");
    const userProfile = document.getElementById("userProfile");
    const logoutBtn = document.getElementById("logoutBtn");

    userToggle.addEventListener("click", (e) => {
      e.stopPropagation();
      dropdownMenu.classList.toggle("open");
    });

    document.addEventListener("click", (e) => {
      if (!dropdownMenu.contains(e.target) && !userToggle.contains(e.target)) {
        dropdownMenu.classList.remove("open");
      }
    });


  </script>
  <script>
    const productos = [
      <?php
      $destacados->data_seek(0);
      while ($p = $destacados->fetch_assoc()) {
        echo "{
      id: " . $p['id'] . ",
      nombre: '" . addslashes($p['nombre_producto']) . "',
      precio: " . $p['precio'] . ",
      descripcion: '" . addslashes($p['descripcion']) . "',
      imagen: 'uploads/" . $p['imagen'] . "',
      categoria: '" . $p['categoria'] . "'
    },";
      }
      ?>
    ];
  </script>


  <script>
    document.querySelectorAll(".add-to-cart").forEach(btn => {
      btn.addEventListener("click", () => {
        const id = parseInt(btn.dataset.id);

        addToCart(id);

        fetch("actualizar_stock.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `id=${id}`
          })
          .then(response => response.json())
          .then(data => {
            if (!data.success) {
              alert("⚠️ " + data.message);
            } else {
              console.log("Stock actualizado para producto ID " + id);
            }
          })
          .catch(error => console.error("Error al actualizar stock:", error));
      });
    });
  </script>
  



  <script src="js/cart.js"></script>
</body>

</html>