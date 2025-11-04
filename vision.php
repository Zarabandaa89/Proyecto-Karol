<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nuestra Visión | Chic Royale</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <link rel="stylesheet" href="css/vision.css">

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
        <a href="#"><i class="fa-regular fa-heart"></i></a>

        <!-- 🛒 Icono del carrito -->
        <button class="icon-btn" id="cartToggle">
          <i class="fa-solid fa-cart-shopping"></i>
          <span class="cart-badge" id="cartCount">0</span>
        </button>

        <!-- 👤 Menú de usuario -->
        <div class="user-menu">
          <div class="user-toggle" id="userToggle">
            <i class="fa-solid fa-user"></i>
          </div>

          <div class="dropdown-menu" id="dropdownMenu">
            <!-- Invitado -->
            <div class="guest-links" id="guestLinks">
              <div class="dropdown-header">
                <i class="fa-solid fa-user-circle"></i>
                <h3>Bienvenido</h3>
                <p>Inicia sesión o regístrate</p>
              </div>
              <div class="dropdown-links">
                <a href="login.php">
                  <i class="fa-solid fa-right-to-bracket"></i>
                  <span>Iniciar Sesión</span>
                </a>
                <a href="Registro.php">
                  <i class="fa-solid fa-user-plus"></i>
                  <span>Registrarse</span>
                </a>
              </div>
            </div>

            <!-- Usuario autenticado -->
            <div class="user-profile" id="userProfile">
              <div class="dropdown-header">
                <i class="fa-solid fa-user-circle"></i>
                <h3 id="userName">Usuario</h3>
                <p id="userEmail">email@ejemplo.com</p>
              </div>
              <div class="dropdown-links">
                <a href="perfil.html">
                  <i class="fa-solid fa-user"></i>
                  <span>Mi Perfil</span>
                </a>
                <a href="pedidos.html">
                  <i class="fa-solid fa-box"></i>
                  <span>Mis Pedidos</span>
                </a>
                <a href="favoritos.html">
                  <i class="fa-solid fa-heart"></i>
                  <span>Favoritos</span>
                </a>
                <a href="#" id="logoutBtn">
                  <i class="fa-solid fa-right-from-bracket"></i>
                  <span>Cerrar Sesión</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <section class="hero">
    <div class="hero-content">
      <h1>🌟 Nuestra Visión 🌟</h1>
      <p>Liderando el futuro de la belleza digital</p>
    </div>
  </section>

  <div class="container">
    <div class="vision-card">
      <div class="vision-intro">
        <h2>
          <i class="fa-solid fa-rocket"></i>
          Hacia Dónde Vamos
          <i class="fa-solid fa-rocket"></i>
        </h2>
        <p>
          Nuestra visión en <strong>Chic Royale</strong> es liderar una nueva era en la industria de la belleza en la 
          localidad de Usme, siendo la plataforma digital de referencia para todos. Soñamos con transformar la manera 
          en que las personas compran y experimentan productos de belleza, eliminando barreras de tiempo, distancia y 
          acceso directo a cada consumidor, sin intermediarios.
        </p>
        <br>
        <p>
          Visualizamos un futuro en el que cada persona pueda acceder fácilmente a productos de belleza premium, con la 
          seguridad de estar comprando productos auténticos y de calidad. Queremos crear una experiencia de compra 
          intuitiva, rápida y eficiente, donde cada usuario se sienta valorado, acompañado y empoderado para explorar 
          su belleza única.
        </p>
      </div>

      <div class="objetivos-grid">
        <div class="objetivo-card">
          <div class="objetivo-number">1</div>
          <h3>Plataforma Líder</h3>
          <p>Convertirnos en la plataforma digital #1 de belleza en Usme y expandirnos a toda Bogotá, siendo reconocidos por nuestra excelencia.</p>
        </div>

        <div class="objetivo-card">
          <div class="objetivo-number">2</div>
          <h3>Innovación Constante</h3>
          <p>A través de la tecnología avanzada y una selección curada de productos de alto nivel, buscar constantemente mejorar la experiencia del cliente.</p>
        </div>

        <div class="objetivo-card">
          <div class="objetivo-number">3</div>
          <h3>Acceso Universal</h3>
          <p>Facilitar el acceso a cosméticos exclusivos para todos, democratizando la belleza sin importar la ubicación o presupuesto.</p>
        </div>

        <div class="objetivo-card">
          <div class="objetivo-number">4</div>
          <h3>Experiencia Premium</h3>
          <p>Ofrecer no solo productos, sino experiencias de belleza que potencien la autoestima y acompañen a nuestros clientes en cada paso.</p>
        </div>

        <div class="objetivo-card">
          <div class="objetivo-number">5</div>
          <h3>Consumo Consciente</h3>
          <p>Promover un movimiento hacia una forma de consumir más consciente, elegante y personal, respetando el medio ambiente.</p>
        </div>

        <div class="objetivo-card">
          <div class="objetivo-number">6</div>
          <h3>Comunidad Global</h3>
          <p>Crear una comunidad de belleza donde cada persona se sienta parte de algo más grande, compartiendo experiencias y consejos.</p>
        </div>
      </div>
    </div>

    <div class="futuro-section">
      <h2>✨ El Futuro que Construimos ✨</h2>
      <p style="text-align:center; color:#666; max-width:800px; margin:0 auto 20px; line-height:1.8;">
        En <strong>Chic Royale</strong>, no somos solo una aplicación de belleza, somos un movimiento hacia una nueva 
        forma de consumir: más consciente, más elegante y profundamente personal. Trabajamos cada día para hacer realidad esta visión.
      </p>

      <div class="futuro-grid">
        <div class="futuro-item">
          <i class="fa-solid fa-globe"></i>
          <h4>Expansión Nacional</h4>
          <p>Llegar a todas las ciudades de Colombia con nuestros servicios premium de belleza.</p>
        </div>

        <div class="futuro-item">
          <i class="fa-solid fa-mobile-screen"></i>
          <h4>Tecnología de Punta</h4>
          <p>Implementar realidad aumentada para probar productos virtualmente antes de comprar.</p>
        </div>

        <div class="futuro-item">
          <i class="fa-solid fa-users"></i>
          <h4>Comunidad Activa</h4>
          <p>Construir una comunidad vibrante donde compartir tips, tutoriales y experiencias.</p>
        </div>

        <div class="futuro-item">
          <i class="fa-solid fa-leaf"></i>
          <h4>Sostenibilidad</h4>
          <p>Liderar iniciativas eco-friendly y promover marcas comprometidas con el planeta.</p>
        </div>

        <div class="futuro-item">
          <i class="fa-solid fa-graduation-cap"></i>
          <h4>Educación en Belleza</h4>
          <p>Ofrecer cursos y talleres para empoderar a nuestros clientes con conocimiento experto.</p>
        </div>

        <div class="futuro-item">
          <i class="fa-solid fa-heart-pulse"></i>
          <h4>Belleza Inclusiva</h4>
          <p>Celebrar la diversidad y ofrecer productos para todos los tonos, tipos y estilos.</p>
        </div>
      </div>
    </div>

    <div class="metas-section">
      <h2>🎯 Nuestras Metas 2025-2030</h2>
      <div class="metas-timeline">
        <div class="meta-item">
          <h4><i class="fa-solid fa-star"></i> 2025: Consolidación Local</h4>
          <p>Convertirnos en la plataforma preferida de belleza en Usme con más de 10,000 clientes satisfechos y alianzas con las mejores marcas internacionales.</p>
        </div>

        <div class="meta-item">
          <h4><i class="fa-solid fa-star"></i> 2026: Expansión Regional</h4>
          <p>Extender nuestros servicios a toda Bogotá y municipios cercanos, alcanzando 50,000 usuarios activos y abriendo nuestro primer centro de experiencia física.</p>
        </div>

        <div class="meta-item">
          <h4><i class="fa-solid fa-star"></i> 2027: Reconocimiento Nacional</h4>
          <p>Ser reconocidos como una de las top 3 plataformas de belleza en Colombia, con presencia en las principales ciudades del país.</p>
        </div>

        <div class="meta-item">
          <h4><i class="fa-solid fa-star"></i> 2028: Innovación Tecnológica</h4>
          <p>Lanzar nuestra app con realidad aumentada y AI personalizada, revolucionando la forma en que las personas descubren productos ideales para ellas.</p>
        </div>

        <div class="meta-item">
          <h4><i class="fa-solid fa-star"></i> 2030: Líder Latinoamericano</h4>
          <p>Expandirnos a mercados internacionales en Latinoamérica, siendo referente en comercio digital de belleza con más de 1 millón de usuarios.</p>
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

  <div id="cartSidebar" class="cart-sidebar">
    <div class="cart-header">
      <h2>Tu Carrito</h2>
      <button id="closeCart"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div id="cartItems" class="cart-items"></div>
    <div class="cart-footer">
      <p>Total: <span id="cartTotal">$0</span></p>
      <button class="checkout-btn">Finalizar Compra</button>
    </div>
  </div>

  <!-- Fondo oscuro del carrito -->
  <div id="cartOverlay" class="cart-overlay"></div>

  <!-- 👤 Script de usuario -->
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

  <!-- 🛒 Script compartido del carrito -->
  <script src="js/cart.js"></script>
</body>
</html>
