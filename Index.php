<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página Principal | Chic Royale</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      background: #fff0f5;
      overflow-x: hidden;
    }

    /* HEADER */
    header {
      background: linear-gradient(135deg, #ffb6c1, #ff69b4);
      padding: 15px 30px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      position: sticky;
      top: 0;
      z-index: 100;
    }

    .barra-superior {
      display: flex;
      justify-content: space-between;
      align-items: center;
      max-width: 1400px;
      margin: 0 auto;
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .logo-icon {
      width: 45px;
      height: 45px;
      background: white;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.2);
    }

    .logo a {
      color: white;
      font-size: 28px;
      font-weight: bold;
      text-decoration: none;
      letter-spacing: 1px;
      transition: transform 0.3s;
      display: inline-block;
    }

    .logo a:hover {
      transform: scale(1.05);
    }

    .menu {
      display: flex;
      gap: 30px;
    }

    .menu a {
      color: white;
      text-decoration: none;
      font-size: 16px;
      font-weight: 500;
      transition: all 0.3s;
      padding: 8px 15px;
      border-radius: 20px;
    }

    .menu a:hover {
      background: rgba(255, 255, 255, 0.2);
    }

    .iconos {
      display: flex;
      gap: 15px;
      align-items: center;
      position: relative;
    }

    .iconos a, .iconos .icon-btn {
      color: white;
      font-size: 22px;
      transition: all 0.3s;
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      position: relative;
      cursor: pointer;
      background: transparent;
      border: none;
    }

    .iconos a:hover, .iconos .icon-btn:hover {
      background: rgba(255, 255, 255, 0.2);
      transform: translateY(-3px);
    }

    .cart-badge {
      position: absolute;
      top: -5px;
      right: -5px;
      background: #ff1493;
      color: white;
      border-radius: 50%;
      width: 20px;
      height: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 11px;
      font-weight: bold;
      border: 2px solid white;
    }

    /* MENÚ USUARIO */
    .user-menu {
      position: relative;
    }

    .user-toggle {
      background: rgba(255, 255, 255, 0.2);
      border: 2px solid white;
      border-radius: 50%;
      width: 42px;
      height: 42px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.3s;
    }

    .user-toggle:hover {
      background: rgba(255, 255, 255, 0.3);
      transform: scale(1.1);
    }

    .user-toggle i {
      color: white;
      font-size: 20px;
    }

    .dropdown-menu {
      position: absolute;
      top: 50px;
      right: 0;
      background: white;
      border-radius: 15px;
      box-shadow: 0 10px 40px rgba(0,0,0,0.2);
      width: 240px;
      opacity: 0;
      visibility: hidden;
      transform: translateY(-10px);
      transition: all 0.3s;
      z-index: 1000;
    }

    .dropdown-menu.open {
      opacity: 1;
      visibility: visible;
      transform: translateY(0);
    }

    .dropdown-header {
      padding: 20px;
      border-bottom: 1px solid #f0f0f0;
      text-align: center;
    }

    .dropdown-header i {
      font-size: 40px;
      color: #ff69b4;
      margin-bottom: 10px;
    }

    .dropdown-header h3 {
      color: #333;
      font-size: 16px;
      margin-bottom: 5px;
    }

    .dropdown-header p {
      color: #999;
      font-size: 13px;
    }

    .dropdown-links {
      padding: 10px 0;
    }

    .dropdown-links a {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      padding: 12px 20px;
      color: #333;
      text-decoration: none;
      transition: all 0.3s;
    }

    .dropdown-links a:hover {
      background: #fff0f5;
      color: #ff69b4;
    }

    .dropdown-links a i {
      font-size: 18px;
    }

    .user-profile {
      display: none;
    }

    .user-profile.active {
      display: block;
    }

    .guest-links.hidden {
      display: none;
    }

    /* MODAL CARRITO */
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.7);
      z-index: 2000;
      animation: fadeIn 0.3s;
    }

    .modal.active {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    .modal-content {
      background: white;
      border-radius: 25px;
      width: 90%;
      max-width: 600px;
      max-height: 80vh;
      overflow-y: auto;
      animation: slideDown 0.3s;
      box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    }

    @keyframes slideDown {
      from {
        transform: translateY(-50px);
        opacity: 0;
      }
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .modal-header {
      background: linear-gradient(135deg, #ff69b4, #ff1493);
      color: white;
      padding: 25px;
      border-radius: 25px 25px 0 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .modal-header h2 {
      font-size: 24px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .close-modal {
      background: rgba(255, 255, 255, 0.2);
      border: none;
      color: white;
      font-size: 28px;
      cursor: pointer;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s;
    }

    .close-modal:hover {
      background: rgba(255, 255, 255, 0.3);
      transform: rotate(90deg);
    }

    .modal-body {
      padding: 25px;
    }

    .cart-empty {
      text-align: center;
      padding: 40px 20px;
      color: #999;
    }

    .cart-empty i {
      font-size: 80px;
      color: #ffb6c1;
      margin-bottom: 20px;
    }

    .cart-empty p {
      font-size: 18px;
      margin-bottom: 20px;
    }

    .cart-item {
      display: flex;
      gap: 15px;
      padding: 20px;
      background: #fff0f5;
      border-radius: 15px;
      margin-bottom: 15px;
      align-items: center;
      transition: all 0.3s;
    }

    .cart-item:hover {
      transform: translateX(5px);
      box-shadow: 0 5px 15px rgba(255, 105, 180, 0.2);
    }

    .cart-item-image {
      width: 80px;
      height: 80px;
      border-radius: 10px;
      overflow: hidden;
      background: linear-gradient(135deg, #ffb6c1, #ff69b4);
      flex-shrink: 0;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .cart-item-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .cart-item-details {
      flex: 1;
    }

    .cart-item-details h4 {
      color: #333;
      margin-bottom: 8px;
      font-size: 16px;
    }

    .cart-item-details p {
      color: #ff69b4;
      font-weight: bold;
      font-size: 18px;
    }

    .cart-item-quantity {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-top: 10px;
    }

    .qty-btn {
      background: #ff69b4;
      color: white;
      border: none;
      width: 30px;
      height: 30px;
      border-radius: 50%;
      cursor: pointer;
      font-size: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s;
    }

    .qty-btn:hover {
      background: #ff1493;
      transform: scale(1.1);
    }

    .qty-number {
      font-weight: bold;
      color: #333;
      min-width: 30px;
      text-align: center;
    }

    .remove-item {
      background: #ff4444;
      color: white;
      border: none;
      padding: 8px 12px;
      border-radius: 8px;
      cursor: pointer;
      font-size: 12px;
      transition: all 0.3s;
    }

    .remove-item:hover {
      background: #cc0000;
      transform: scale(1.05);
    }

    .cart-total {
      background: linear-gradient(135deg, #fff0f5, #ffe4ec);
      padding: 20px;
      border-radius: 15px;
      margin-top: 20px;
    }

    .cart-total-row {
      display: flex;
      justify-content: space-between;
      margin-bottom: 10px;
      color: #666;
    }

    .cart-total-final {
      display: flex;
      justify-content: space-between;
      font-size: 24px;
      font-weight: bold;
      color: #ff69b4;
      padding-top: 15px;
      border-top: 2px solid #ff69b4;
      margin-top: 10px;
    }

    .checkout-btn {
      background: linear-gradient(135deg, #ff69b4, #ff1493);
      color: white;
      border: none;
      padding: 15px 30px;
      border-radius: 25px;
      cursor: pointer;
      font-weight: bold;
      font-size: 16px;
      width: 100%;
      margin-top: 20px;
      transition: all 0.3s;
      box-shadow: 0 5px 20px rgba(255, 105, 180, 0.3);
    }

    .checkout-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 30px rgba(255, 105, 180, 0.5);
    }

    .checkout-btn:disabled {
      background: #ccc;
      cursor: not-allowed;
      transform: none;
    }

    /* HERO BANNER */
    .hero-banner {
      position: relative;
      height: 500px;
      background: linear-gradient(135deg, #ff69b4 0%, #ff1493 50%, #c71585 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      margin-bottom: 50px;
    }

    .hero-banner::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,138.7C960,139,1056,117,1152,101.3C1248,85,1344,75,1392,69.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
      background-size: cover;
      background-position: bottom;
    }

    .hero-content {
      position: relative;
      z-index: 2;
      text-align: center;
      color: white;
      max-width: 800px;
      padding: 0 20px;
      animation: fadeInUp 1s ease;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .hero-content h1 {
      font-size: 56px;
      margin-bottom: 20px;
      text-shadow: 2px 2px 10px rgba(0,0,0,0.2);
      font-weight: bold;
    }

    .hero-content p {
      font-size: 22px;
      margin-bottom: 30px;
      opacity: 0.95;
    }

    .hero-btn {
      display: inline-block;
      padding: 15px 40px;
      background: white;
      color: #ff69b4;
      text-decoration: none;
      border-radius: 50px;
      font-weight: bold;
      font-size: 18px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.2);
      transition: all 0.3s;
    }

    .hero-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 30px rgba(0,0,0,0.3);
    }

    .floating-elements {
      position: absolute;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      pointer-events: none;
    }

    .floating-elements span {
      position: absolute;
      font-size: 40px;
      opacity: 0.2;
      animation: float 6s ease-in-out infinite;
    }

    .floating-elements span:nth-child(1) {
      top: 10%;
      left: 10%;
      animation-delay: 0s;
    }

    .floating-elements span:nth-child(2) {
      top: 20%;
      right: 15%;
      animation-delay: 1s;
    }

    .floating-elements span:nth-child(3) {
      bottom: 15%;
      left: 20%;
      animation-delay: 2s;
    }

    .floating-elements span:nth-child(4) {
      bottom: 20%;
      right: 10%;
      animation-delay: 1.5s;
    }

    @keyframes float {
      0%, 100% {
        transform: translateY(0) rotate(0deg);
      }
      50% {
        transform: translateY(-20px) rotate(10deg);
      }
    }

    /* CATEGORÍAS */
    .categorias-section {
      max-width: 1200px;
      margin: 0 auto 80px;
      padding: 0 20px;
    }

    .titulo-categorias {
      text-align: center;
      color: #ff69b4;
      font-size: 36px;
      margin-bottom: 50px;
      font-weight: bold;
    }

    .categorias {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 40px;
    }

    .categoria {
      text-align: center;
      cursor: pointer;
      transition: all 0.4s;
      position: relative;
    }

    .categoria:hover {
      transform: translateY(-15px);
    }

    .categoria-imagen {
      width: 160px;
      height: 160px;
      border-radius: 50%;
      overflow: hidden;
      margin: 0 auto 20px;
      border: 5px solid #ff69b4;
      box-shadow: 0 10px 30px rgba(255, 105, 180, 0.3);
      transition: all 0.4s;
      background: linear-gradient(135deg, #fff0f5, #ffe4ec);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .categoria:hover .categoria-imagen {
      border-color: #ff1493;
      box-shadow: 0 15px 40px rgba(255, 105, 180, 0.5);
      transform: scale(1.1);
    }

    .categoria-imagen i {
      font-size: 80px;
      color: #ff69b4;
    }

    .categoria p {
      color: #333;
      font-weight: bold;
      font-size: 20px;
      transition: color 0.3s;
    }

    .categoria:hover p {
      color: #ff69b4;
    }

    /* PRODUCTOS DESTACADOS */
    .destacados {
      background: white;
      padding: 80px 20px;
      margin-bottom: 80px;
    }

    .destacados h2 {
      text-align: center;
      color: #ff69b4;
      font-size: 36px;
      margin-bottom: 50px;
      font-weight: bold;
    }

    .productos-grid {
      max-width: 1200px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 40px;
    }

    .producto {
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.08);
      padding: 25px;
      text-align: center;
      transition: all 0.4s;
      position: relative;
      overflow: hidden;
    }

    .producto::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 5px;
      background: linear-gradient(90deg, #ff69b4, #ff1493);
      transform: scaleX(0);
      transition: transform 0.4s;
    }

    .producto:hover::before {
      transform: scaleX(1);
    }

    .producto:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 40px rgba(255, 105, 180, 0.2);
    }

    .producto-imagen {
      width: 100%;
      height: 250px;
      border-radius: 15px;
      overflow: hidden;
      margin-bottom: 20px;
      background: linear-gradient(135deg, #fff0f5, #ffe4ec);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .producto-imagen i {
      font-size: 100px;
      color: #ff69b4;
    }

    .producto h3 {
      color: #333;
      font-size: 20px;
      margin-bottom: 10px;
    }

    .producto-precio {
      color: #ff69b4;
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 15px;
    }

    .producto-btn {
      background: linear-gradient(135deg, #ff69b4, #ff1493);
      color: white;
      border: none;
      padding: 12px 30px;
      border-radius: 25px;
      cursor: pointer;
      font-weight: bold;
      font-size: 15px;
      transition: all 0.3s;
      box-shadow: 0 4px 15px rgba(255, 105, 180, 0.3);
    }

    .producto-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(255, 105, 180, 0.5);
    }

    /* INFO SECTION */
    .info-section {
      max-width: 1200px;
      margin: 0 auto 80px;
      padding: 0 20px;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 40px;
    }

    .info-card {
      background: white;
      border-radius: 20px;
      padding: 40px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.08);
      text-align: center;
      transition: all 0.4s;
      border: 3px solid transparent;
    }

    .info-card:hover {
      transform: translateY(-10px);
      border-color: #ff69b4;
      box-shadow: 0 15px 40px rgba(255, 105, 180, 0.2);
    }

    .info-card i {
      font-size: 50px;
      color: #ff69b4;
      margin-bottom: 20px;
    }

    .info-card h3 {
      color: #ff69b4;
      font-size: 24px;
      margin-bottom: 15px;
    }

    .info-card p {
      color: #666;
      font-size: 16px;
      line-height: 1.6;
    }

    footer {
      background: linear-gradient(135deg, #ffb6c1, #ff69b4);
      color: white;
      text-align: center;
      padding: 30px 20px;
      font-size: 16px;
    }

    @media (max-width: 768px) {
      .hero-content h1 {
        font-size: 36px;
      }
      
      .menu {
        display: none;
      }
      
      .categorias {
        grid-template-columns: repeat(2, 1fr);
        gap: 25px;
      }
      
      .categoria-imagen {
        width: 120px;
        height: 120px;
      }

      .modal-content {
        width: 95%;
        max-height: 90vh;
      }
    }

    @keyframes slideIn {
      from {
        transform: translateX(400px);
        opacity: 0;
      }
      to {
        transform: translateX(0);
        opacity: 1;
      }
    }

    @keyframes slideOut {
      from {
        transform: translateX(0);
        opacity: 1;
      }
      to {
        transform: translateX(400px);
        opacity: 0;
      }
    }
  </style>
</head>

<body>
  <header>
    <div class="barra-superior">
      <div class="logo">
        <div class="logo-icon">💄</div>
        <a href="#" onclick="return false;">Chic Royale</a>
      </div>
      <nav class="menu">
        <a href="#" onclick="scrollToTop(); return false;">Inicio</a>
        <a href="#productos-section">Productos</a>
        <a href="#mision-section">Misión</a>
        <a href="#vision-section">Visión</a>
      </nav>
      <div class="iconos">
        <a href="#" onclick="alert('Función de favoritos próximamente'); return false;">
          <i class="fa-regular fa-heart"></i>
        </a>
        
        <button class="icon-btn" id="cartBtn">
          <i class="fa-solid fa-cart-shopping"></i>
          <span class="cart-badge" id="cartBadge">0</span>
        </button>
        
        <div class="user-menu">
          <div class="user-toggle" id="userToggle">
            <i class="fa-solid fa-user"></i>
          </div>
          
          <div class="dropdown-menu" id="dropdownMenu">
            <div class="guest-links" id="guestLinks">
              <div class="dropdown-header">
                <i class="fa-solid fa-user-circle"></i>
                <h3>Bienvenido</h3>
                <p>Inicia sesión o regístrate</p>
              </div>
              <div class="dropdown-links">
                <a href="#" onclick="alert('Redirigiendo a Inicio de Sesión...'); return false;">
                  <i class="fa-solid fa-right-to-bracket"></i>
                  <span>Iniciar Sesión</span>
                </a>
                <a href="#" onclick="alert('Redirigiendo a Registro...'); return false;">
                  <i class="fa-solid fa-user-plus"></i>
                  <span>Registrarse</span>
                </a>
              </div>
            </div>

            <div class="user-profile" id="userProfile">
              <div class="dropdown-header">
                <i class="fa-solid fa-user-circle"></i>
                <h3 id="userName">Usuario</h3>
                <p id="userEmail">email@ejemplo.com</p>
              </div>
              <div class="dropdown-links">
                <a href="#" onclick="alert('Ver perfil'); return false;">
                  <i class="fa-solid fa-user"></i>
                  <span>Mi Perfil</span>
                </a>
                <a href="#" onclick="alert('Ver pedidos'); return false;">
                  <i class="fa-solid fa-box"></i>
                  <span>Mis Pedidos</span>
                </a>
                <a href="#" onclick="alert('Ver favoritos'); return false;">
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

  <!-- MODAL DEL CARRITO -->
  <div class="modal" id="cartModal">
    <div class="modal-content">
      <div class="modal-header">
        <h2><i class="fa-solid fa-cart-shopping"></i> Mi Carrito</h2>
        <button class="close-modal" id="closeCart">&times;</button>
      </div>
      <div class="modal-body" id="cartBody">
        <div class="cart-empty">
          <i class="fa-solid fa-cart-shopping"></i>
          <p>Tu carrito está vacío</p>
          <a href="#productos-section" class="hero-btn" onclick="closeCartModal()">Ir a comprar</a>
        </div>
      </div>
    </div>
  </div>

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
      <a href="#productos-section" class="hero-btn">
        <i class="fa-solid fa-shopping-bag"></i> Comprar Ahora
      </a>
       <?php include 'includes/footer.php'; ?>
  <script src="js/main.js"></script>
  <script src="js/cart.js"></script>
</body>
</html>