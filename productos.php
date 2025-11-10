<?php
session_start();
include "includes/conexion.php";
?>
<?php if (isset($_GET['mensaje']) && $_GET['mensaje'] == 'cuenta_eliminada'): ?>
  <script>
    alert("Tu cuenta ha sido eliminada correctamente.");
  </script>
<?php endif; ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Productos | Chic Royale</title>
  <link rel="stylesheet" href="css/productos.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body>
  <header>
    <div class="barra-superior">
      <div class="logo">
        <a href="index.php">◉ Chic Royale</a>
      </div>

      <nav class="menu">
        <a href="index.php">Inicio</a>
        <a href="productos.php" class="active">Productos</a>
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
              <div class="user-profile active" id="userProfile">
                <div class="dropdown-header">
                  <i class="fa-solid fa-user-circle"></i>
                  <h3><?= htmlspecialchars($_SESSION['usuario_nombre']); ?></h3>
                  <p><?= htmlspecialchars($_SESSION['usuario_email']); ?></p>
                </div>

                <div class="dropdown-links">
                  <a href="perfil.php"><i class="fa-solid fa-user"></i><span>Mi Perfil</span></a>
                  <a href="pedidos.php"><i class="fa-solid fa-box"></i><span>Mis Pedidos</span></a>
                  <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i><span>Cerrar Sesión</span></a>
                </div>
              </div>
            <?php else: ?>
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

  <section class="hero-productos">
    <div class="hero-content-productos">
      <h1>Catálogo de Productos</h1>
      <p>Encuentra tu estilo perfecto con nuestra colección exclusiva</p>
      <div class="hero-stats">
        <div class="stat-item">
          <div class="stat-number">50+</div>
          <div class="stat-label">Productos</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">100%</div>
          <div class="stat-label">Originales</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">⭐⭐⭐⭐⭐</div>
          <div class="stat-label">Calidad Premium</div>
        </div>
      </div>
    </div>
  </section>

  <section class="filtros-section">
    <div class="filtros">
      <button class="filtro-btn active" data-filter="todos">Todos</button>
      <button class="filtro-btn" data-filter="labios">💋 Labios</button>
      <button class="filtro-btn" data-filter="ojos">👁️ Ojos</button>
      <button class="filtro-btn" data-filter="piel">✨ Piel</button>
      <button class="filtro-btn" data-filter="mejillas">🎨 Mejillas</button>
      <button class="filtro-btn" data-filter="accesorios">🛍️ Accesorios</button>
    </div>
  </section>

  <section class="productos-container">
    <div class="productos-grid" id="productosGrid">
      <?php
      $sql = "SELECT * FROM productos_1";
      $resultado = $conn->query($sql);

      if ($resultado->num_rows > 0) {
        while ($producto = $resultado->fetch_assoc()) {
          echo '
          <div class="producto-card" data-categoria="' . $producto['categoria'] . '">
            ' . (!empty($producto['badge']) ? '<span class="producto-badge">' . $producto['badge'] . '</span>' : '') . '
            <div class="producto-imagen">
              <img src="uploads/' . $producto['imagen'] . '" alt="' . $producto['nombre_producto'] . '">
            </div>
            <div class="producto-info">
              <div class="producto-categoria">' . ucfirst($producto['categoria']) . '</div>
              <div class="producto-nombre">' . $producto['nombre_producto'] . '</div>
              <div class="producto-descripcion">' . $producto['descripcion'] . '</div>
              <div class="producto-footer">
                <div class="producto-precio">$' . number_format($producto['precio'], 0, ',', '.') . '</div>
                <button class="add-to-cart-btn" data-id="' . $producto['id'] . '">
                  <i class="fa-solid fa-cart-plus"></i>
                  Agregar
                </button>
              </div>
            </div>
          </div>';
        }
      } else {
        echo "<p>No hay productos disponibles en este momento.</p>";
      }
      ?>
    </div>
  </section>



  <div class="cart-overlay" id="cartOverlay"></div>
  <aside class="cart-sidebar" id="cartSidebar">
    <div class="cart-header">
      <h2><i class="fa-solid fa-shopping-bag"></i> Mi Carrito</h2>
      <button class="close-cart" id="closeCart">
        <i class="fa-solid fa-times"></i>
      </button>
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

  <footer>
    © 2025 Chic Royale - Todos los derechos reservados 💄
  </footer>

  <script>
    document.querySelectorAll('.filtro-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        document.querySelectorAll('.filtro-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        const filtro = this.dataset.filter;
        document.querySelectorAll('.producto-card').forEach(card => {
          card.style.display = (filtro === 'todos' || card.dataset.categoria === filtro) ? 'block' : 'none';
        });
      });
    });
  </script>

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

    function checkLoginStatus() {
      const user = JSON.parse(localStorage.getItem('currentUser'));
      if (user) {
        guestLinks.classList.add('hidden');
        userProfile.classList.add('active');
        document.getElementById('userName').textContent = user.name || 'Usuario';
        document.getElementById('userEmail').textContent = user.email || '';
      } else {
        guestLinks.classList.remove('hidden');
        userProfile.classList.remove('active');
      }
    }

    if (logoutBtn) {
      logoutBtn.addEventListener('click', (e) => {
        e.preventDefault();
        localStorage.removeItem('currentUser');
        checkLoginStatus();
        dropdownMenu.classList.remove('open');
        alert('Has cerrado sesión correctamente');
      });
    }

    checkLoginStatus();
  </script>

  <script>
    window.productos = [
      <?php
      $resultado->data_seek(0);
      while ($producto = $resultado->fetch_assoc()) {
        echo "{
          id: " . $producto['id'] . ",
          nombre: '" . addslashes($producto['nombre_producto']) . "',
          descripcion: '" . addslashes($producto['descripcion']) . "',
          precio: " . $producto['precio'] . ",
          imagen: 'uploads/" . $producto['imagen'] . "',
          categoria: '" . $producto['categoria'] . "'
        },";
      }
      ?>
    ];
  </script>

  <script src="js/cart.js" defer></script>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      document.querySelectorAll(".add-to-cart-btn").forEach(btn => {
        btn.addEventListener("click", () => {
          const id = parseInt(btn.dataset.id);
          addToCart(id);
        });
      });

      document.getElementById('checkoutBtn').addEventListener('click', () => {
        if (cart.length === 0) {
          alert("⚠️ Tu carrito está vacío.");
        } else {
          window.location.href = "checkout.php";
        }
      });
    });
  </script>
</body>

</html>