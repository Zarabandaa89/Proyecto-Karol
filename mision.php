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
  <title>Nuestra Misión | Chic Royale</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="css/mision.css">
</head>

<body>
  <header>
    <div class="barra-superior">
      <div class="logo">
        <a href="index.php">◉ Chic Royale</a>
      </div>
      <nav class="menu">
        <a href="index.php">Inicio</a>
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

  <section class="hero">
    <div class="hero-content">
      <h1>✨ Nuestra Misión ✨</h1>
      <p>Transformando la experiencia de belleza, una persona a la vez</p>
    </div>
  </section>

  <div class="container">
    <div class="mission-card">
      <div class="mission-intro">
        <h2>
          <i class="fa-solid fa-heart"></i>
          ¿Qué nos impulsa?
          <i class="fa-solid fa-heart"></i>
        </h2>
        <p>
          En <strong>Chic Royale</strong>, nuestra misión es transformar y revolucionar la experiencia de compra de maquillaje,
          acercando de manera directa a los consumidores con marcas de alta gama reconocidas mundialmente, pero a precios
          accesibles y justos.
        </p>
      </div>

      <div class="valores-grid">
        <div class="valor-card">
          <div class="valor-icon"><i class="fa-solid fa-gem"></i></div>
          <h3>Calidad Premium</h3>
          <p>Seleccionamos cuidadosamente productos premium que garantizan calidad, innovación y seguridad.</p>
        </div>

        <div class="valor-card">
          <div class="valor-icon"><i class="fa-solid fa-hand-holding-heart"></i></div>
          <h3>Accesibilidad</h3>
          <p>La belleza es un derecho accesible para todos, sin importar su presupuesto o ubicación.</p>
        </div>

        <div class="valor-card">
          <div class="valor-icon"><i class="fa-solid fa-star"></i></div>
          <h3>Experiencia Única</h3>
          <p>Una compra que inspire tranquilidad, satisfacción y empoderamiento.</p>
        </div>

        <div class="valor-card">
          <div class="valor-icon"><i class="fa-solid fa-sparkles"></i></div>
          <h3>Confianza</h3>
          <p>Brindamos productos auténticos y atención cercana para ganar tu confianza.</p>
        </div>

        <div class="valor-card">
          <div class="valor-icon"><i class="fa-solid fa-rocket"></i></div>
          <h3>Innovación</h3>
          <p>Usamos tecnología avanzada para mejorar la experiencia de compra.</p>
        </div>

        <div class="valor-card">
          <div class="valor-icon"><i class="fa-solid fa-crown"></i></div>
          <h3>Empoderamiento</h3>
          <p>Te ayudamos a resaltar tu mejor versión con confianza.</p>
        </div>
      </div>
    </div>

    <div class="compromiso-section">
      <h2>💄 Nuestro Compromiso Contigo 💋</h2>
      <div class="compromiso-list">
        <div class="compromiso-item">
          <i class="fa-solid fa-shield-heart"></i>
          <div>
            <h4>Productos Auténticos</h4>
            <p>Solo trabajamos con marcas verificadas.</p>
          </div>
        </div>
        <div class="compromiso-item">
          <i class="fa-solid fa-truck-fast"></i>
          <div>
            <h4>Entrega Rápida</h4>
            <p>Recibe tus productos lo más pronto posible.</p>
          </div>
        </div>
        <div class="compromiso-item">
          <i class="fa-solid fa-headset"></i>
          <div>
            <h4>Atención Personalizada</h4>
            <p>Siempre disponibles para ayudarte.</p>
          </div>
        </div>
        <div class="compromiso-item">
          <i class="fa-solid fa-lock"></i>
          <div>
            <h4>Compra Segura</h4>
            <p>Transacciones 100% seguras.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <section class="productos-container">
    <div class="productos-grid" id="productosGrid"></div>
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
    document.addEventListener("DOMContentLoaded", () => {
      const checkoutBtn = document.getElementById('checkoutBtn');
      if (checkoutBtn) {
        checkoutBtn.addEventListener('click', () => {
          if (cart.length === 0) {
            alert("⚠️ Tu carrito está vacío.");
          } else {
            window.location.href = "checkout.php";
          }
        });
      }
    });
  </script>



  <script src="js/cart.js"></script>
</body>

</html>