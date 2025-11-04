<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nuestra Misión | Chic Royale</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Arial', sans-serif;
      background: #fff0f5;
    }

    /* ====== HEADER ====== */
    header {
      background: linear-gradient(135deg, #ffb6c1, #ff69b4);
      padding: 15px 30px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .barra-superior {
      display: flex;
      justify-content: space-between;
      align-items: center;
      max-width: 1400px;
      margin: 0 auto;
    }

    .logo a {
      color: white;
      font-size: 26px;
      font-weight: bold;
      text-decoration: none;
      letter-spacing: 1px;
    }

    .menu {
      display: flex;
      gap: 30px;
    }

    .menu a {
      color: white;
      text-decoration: none;
      font-size: 16px;
      transition: opacity 0.3s;
    }

    .menu a:hover {
      opacity: 0.8;
    }

    .iconos {
      display: flex;
      gap: 20px;
      align-items: center;
    }

    .iconos a {
      color: white;
      font-size: 20px;
      transition: transform 0.3s;
    }

    .iconos a:hover {
      transform: scale(1.1);
    }

    /* ====== MENÚ DE USUARIO ====== */
    .user-menu {
      position: relative;
    }

    .user-toggle {
      background: rgba(255, 255, 255, 0.2);
      border: 2px solid white;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.3s;
    }

    .user-toggle:hover {
      background: rgba(255, 255, 255, 0.3);
    }

    .user-toggle i {
      color: white;
      font-size: 20px;
    }

    .dropdown-menu {
      position: absolute;
      top: 55px;
      right: 0;
      background: white;
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.15);
      min-width: 220px;
      opacity: 0;
      visibility: hidden;
      transform: translateY(-10px);
      transition: all 0.3s ease;
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
      gap: 12px;
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
      width: 24px;
      text-align: center;
    }

    .user-profile {
      display: none;
    }

    .user-profile.active {
      display: block;
    }

    .guest-links {
      display: block;
    }

    .guest-links.hidden {
      display: none;
    }

    /* ====== HERO SECTION ====== */
    .hero {
      background: linear-gradient(135deg, #ff69b4, #ff1493);
      padding: 80px 20px;
      text-align: center;
      color: white;
      position: relative;
      overflow: hidden;
    }

    .hero::before {
      content: '💄';
      position: absolute;
      font-size: 200px;
      opacity: 0.1;
      top: -50px;
      left: 10%;
      animation: float 6s ease-in-out infinite;
    }

    .hero::after {
      content: '💋';
      position: absolute;
      font-size: 150px;
      opacity: 0.1;
      bottom: -30px;
      right: 15%;
      animation: float 5s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-20px); }
    }

    .hero-content {
      max-width: 800px;
      margin: 0 auto;
      position: relative;
      z-index: 1;
    }

    .hero h1 {
      font-size: 48px;
      margin-bottom: 20px;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
    }

    .hero p {
      font-size: 20px;
      line-height: 1.6;
      opacity: 0.95;
    }

    /* ====== CONTENIDO PRINCIPAL ====== */
    .container {
      max-width: 1200px;
      margin: -50px auto 50px;
      padding: 0 20px;
      position: relative;
      z-index: 2;
    }

    .mission-card {
      background: white;
      border-radius: 25px;
      padding: 50px;
      box-shadow: 0 10px 40px rgba(0,0,0,0.1);
      margin-bottom: 40px;
    }

    .mission-intro {
      text-align: center;
      margin-bottom: 50px;
    }

    .mission-intro h2 {
      color: #ff69b4;
      font-size: 36px;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 15px;
    }

    .mission-intro p {
      color: #666;
      font-size: 18px;
      line-height: 1.8;
      max-width: 900px;
      margin: 0 auto;
    }

    /* ====== VALORES ====== */
    .valores-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 30px;
      margin-top: 50px;
    }

    .valor-card {
      background: linear-gradient(135deg, #fff0f5, #ffe4ec);
      border-radius: 20px;
      padding: 35px;
      text-align: center;
      transition: all 0.3s;
      border: 3px solid transparent;
    }

    .valor-card:hover {
      transform: translateY(-10px);
      border-color: #ff69b4;
      box-shadow: 0 10px 30px rgba(255, 105, 180, 0.3);
    }

    .valor-icon {
      width: 80px;
      height: 80px;
      background: linear-gradient(135deg, #ff69b4, #ff1493);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
      box-shadow: 0 5px 20px rgba(255, 105, 180, 0.4);
    }

    .valor-icon i {
      font-size: 40px;
      color: white;
    }

    .valor-card h3 {
      color: #333;
      font-size: 22px;
      margin-bottom: 15px;
    }

    .valor-card p {
      color: #666;
      font-size: 15px;
      line-height: 1.6;
    }

    /* ====== COMPROMISO SECTION ====== */
    .compromiso-section {
      background: white;
      border-radius: 25px;
      padding: 50px;
      box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    }

    .compromiso-section h2 {
      color: #ff69b4;
      font-size: 32px;
      margin-bottom: 30px;
      text-align: center;
    }

    .compromiso-list {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 25px;
    }

    .compromiso-item {
      display: flex;
      gap: 20px;
      padding: 20px;
      background: #fff0f5;
      border-radius: 15px;
      transition: all 0.3s;
    }

    .compromiso-item:hover {
      background: linear-gradient(135deg, #fff0f5, #ffe4ec);
      transform: translateX(5px);
    }

    .compromiso-item i {
      font-size: 30px;
      color: #ff69b4;
      flex-shrink: 0;
    }

    .compromiso-item div h4 {
      color: #333;
      font-size: 18px;
      margin-bottom: 8px;
    }

    .compromiso-item div p {
      color: #666;
      font-size: 14px;
      line-height: 1.6;
    }

    footer {
      background: linear-gradient(135deg, #ffb6c1, #ff69b4);
      color: white;
      text-align: center;
      padding: 20px;
      margin-top: 50px;
    }

    @media (max-width: 768px) {
      .hero h1 {
        font-size: 32px;
      }
      
      .mission-card {
        padding: 30px 20px;
      }
      
      .valores-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>
  <!-- ====== HEADER ====== -->
  <header>
    <div class="barra-superior">
      <div class="logo">
        <a href="index.html">◉ Chic Royale</a>
      </div>
      <nav class="menu">
        <a href="index.html">Inicio</a>
        <a href="productos.html">Productos</a>
        <a href="mision.html">Misión</a>
        <a href="vision.html">Visión</a>
      </nav>
      <div class="iconos">
        <a href="#"><i class="fa-regular fa-heart"></i></a>
        <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
        
        <div class="user-menu" id="userMenu">
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
                <a href="login.html">
                  <i class="fa-solid fa-right-to-bracket"></i>
                  <span>Iniciar Sesión</span>
                </a>
                <a href="registro.html">
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

  <!-- ====== HERO ====== -->
  <section class="hero">
    <div class="hero-content">
      <h1>✨ Nuestra Misión ✨</h1>
      <p>Transformando la experiencia de belleza, una persona a la vez</p>
    </div>
  </section>

  <!-- ====== CONTENIDO ====== -->
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
          accesibles y justos. Nos comprometemos a ofrecer una plataforma digital que optimice el tiempo de nuestros clientes, 
          brindándoles una experiencia de compra sencilla, rápida y personalizada, que se adapte a sus necesidades y 
          estilos de vida modernos.
        </p>
      </div>

      <div class="valores-grid">
        <div class="valor-card">
          <div class="valor-icon">
            <i class="fa-solid fa-gem"></i>
          </div>
          <h3>Calidad Premium</h3>
          <p>Seleccionamos cuidadosamente productos premium que garantizan calidad, innovación y seguridad para cada persona.</p>
        </div>

        <div class="valor-card">
          <div class="valor-icon">
            <i class="fa-solid fa-hand-holding-heart"></i>
          </div>
          <h3>Accesibilidad</h3>
          <p>Creemos que la belleza es un derecho accesible para todos, sin importar su presupuesto o ubicación.</p>
        </div>

        <div class="valor-card">
          <div class="valor-icon">
            <i class="fa-solid fa-star"></i>
          </div>
          <h3>Experiencia Única</h3>
          <p>Ofrecemos un proceso de compra que inspire tranquilidad, satisfacción y empoderamiento en cada cliente.</p>
        </div>

        <div class="valor-card">
          <div class="valor-icon">
            <i class="fa-solid fa-sparkles"></i>
          </div>
          <h3>Confianza</h3>
          <p>Brindamos productos auténticos con excelencia en el servicio y atención cercana para ganar tu confianza.</p>
        </div>

        <div class="valor-card">
          <div class="valor-icon">
            <i class="fa-solid fa-rocket"></i>
          </div>
          <h3>Innovación</h3>
          <p>Utilizamos tecnología avanzada para mejorar constantemente la experiencia de compra de nuestros clientes.</p>
        </div>

        <div class="valor-card">
          <div class="valor-icon">
            <i class="fa-solid fa-crown"></i>
          </div>
          <h3>Empoderamiento</h3>
          <p>Acompañamos a cada persona en su rutina diaria, ayudándoles a resaltar su mejor versión con confianza.</p>
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
            <p>Solo trabajamos con marcas verificadas y productos 100% originales.</p>
          </div>
        </div>

        <div class="compromiso-item">
          <i class="fa-solid fa-truck-fast"></i>
          <div>
            <h4>Entrega Rápida</h4>
            <p>Optimizamos el tiempo de envío para que recibas tus productos lo más pronto posible.</p>
          </div>
        </div>

        <div class="compromiso-item">
          <i class="fa-solid fa-headset"></i>
          <div>
            <h4>Atención Personalizada</h4>
            <p>Nuestro equipo está siempre disponible para ayudarte en lo que necesites.</p>
          </div>
        </div>

        <div class="compromiso-item">
          <i class="fa-solid fa-lock"></i>
          <div>
            <h4>Compra Segura</h4>
            <p>Protegemos tus datos y garantizamos transacciones 100% seguras.</p>
          </div>
        </div>

        <div class="compromiso-item">
          <i class="fa-solid fa-leaf"></i>
          <div>
            <h4>Responsabilidad</h4>
            <p>Promovemos prácticas sostenibles y el cuidado del medio ambiente.</p>
          </div>
        </div>

        <div class="compromiso-item">
          <i class="fa-solid fa-smile"></i>
          <div>
            <h4>Satisfacción Garantizada</h4>
            <p>Tu felicidad es nuestra prioridad, trabajamos para superar tus expectativas.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

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
</body>
</html>