<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nuestra Visión | Chic Royale</title>
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
      background: linear-gradient(135deg, #9b59b6, #8e44ad);
      padding: 80px 20px;
      text-align: center;
      color: white;
      position: relative;
      overflow: hidden;
    }

    .hero::before {
      content: '🌟';
      position: absolute;
      font-size: 180px;
      opacity: 0.1;
      top: -40px;
      right: 10%;
      animation: rotate 20s linear infinite;
    }

    .hero::after {
      content: '✨';
      position: absolute;
      font-size: 120px;
      opacity: 0.15;
      bottom: -20px;
      left: 15%;
      animation: float 4s ease-in-out infinite;
    }

    @keyframes rotate {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
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

    /* ====== CONTENIDO ====== */
    .container {
      max-width: 1200px;
      margin: -50px auto 50px;
      padding: 0 20px;
      position: relative;
      z-index: 2;
    }

    .vision-card {
      background: white;
      border-radius: 25px;
      padding: 50px;
      box-shadow: 0 10px 40px rgba(0,0,0,0.1);
      margin-bottom: 40px;
    }

    .vision-intro {
      text-align: center;
      margin-bottom: 50px;
    }

    .vision-intro h2 {
      color: #9b59b6;
      font-size: 36px;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 15px;
    }

    .vision-intro p {
      color: #666;
      font-size: 18px;
      line-height: 1.8;
      max-width: 900px;
      margin: 0 auto;
    }

    /* ====== OBJETIVOS ====== */
    .objetivos-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
      margin-top: 50px;
    }

    .objetivo-card {
      background: linear-gradient(135deg, #f3e5f5, #e1bee7);
      border-radius: 20px;
      padding: 35px;
      transition: all 0.3s;
      border: 3px solid transparent;
    }

    .objetivo-card:hover {
      transform: translateY(-10px);
      border-color: #9b59b6;
      box-shadow: 0 10px 30px rgba(155, 89, 182, 0.3);
    }

    .objetivo-number {
      width: 60px;
      height: 60px;
      background: linear-gradient(135deg, #9b59b6, #8e44ad);
      border-radius: 15px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 20px;
      font-size: 28px;
      font-weight: bold;
      color: white;
      box-shadow: 0 5px 20px rgba(155, 89, 182, 0.4);
    }

    .objetivo-card h3 {
      color: #333;
      font-size: 22px;
      margin-bottom: 15px;
    }

    .objetivo-card p {
      color: #666;
      font-size: 15px;
      line-height: 1.6;
    }

    /* ====== FUTURO SECTION ====== */
    .futuro-section {
      background: white;
      border-radius: 25px;
      padding: 50px;
      box-shadow: 0 10px 40px rgba(0,0,0,0.1);
      margin-bottom: 40px;
    }

    .futuro-section h2 {
      color: #9b59b6;
      font-size: 32px;
      margin-bottom: 30px;
      text-align: center;
    }

    .futuro-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 30px;
      margin-top: 40px;
    }

    .futuro-item {
      text-align: center;
      padding: 30px;
      background: linear-gradient(135deg, #fff0f5, #ffe4ec);
      border-radius: 20px;
      transition: all 0.3s;
    }

    .futuro-item:hover {
      transform: scale(1.05);
      box-shadow: 0 10px 30px rgba(255, 105, 180, 0.2);
    }

    .futuro-item i {
      font-size: 50px;
      color: #ff69b4;
      margin-bottom: 20px;
      display: block;
    }

    .futuro-item h4 {
      color: #333;
      font-size: 20px;
      margin-bottom: 12px;
    }

    .futuro-item p {
      color: #666;
      font-size: 14px;
      line-height: 1.6;
    }

    /* ====== METAS SECTION ====== */
    .metas-section {
      background: linear-gradient(135deg, #9b59b6, #8e44ad);
      border-radius: 25px;
      padding: 50px;
      color: white;
      text-align: center;
    }

    .metas-section h2 {
      font-size: 36px;
      margin-bottom: 30px;
    }

    .metas-timeline {
      max-width: 800px;
      margin: 0 auto;
      position: relative;
    }

    .meta-item {
      background: rgba(255, 255, 255, 0.15);
      border-radius: 15px;
      padding: 25px;
      margin-bottom: 20px;
      text-align: left;
      backdrop-filter: blur(10px);
      border: 2px solid rgba(255, 255, 255, 0.2);
      transition: all 0.3s;
    }

    .meta-item:hover {
      background: rgba(255, 255, 255, 0.25);
      transform: translateX(10px);
    }

    .meta-item h4 {
      font-size: 20px;
      margin-bottom: 10px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .meta-item h4 i {
      color: #ffd700;
    }

    .meta-item p {
      font-size: 15px;
      line-height: 1.6;
      opacity: 0.95;
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
      
      .vision-card, .futuro-section, .metas-section {
        padding: 30px 20px;
      }
      
      .objetivos-grid, .futuro-grid {
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
      <h1>🌟 Nuestra Visión 🌟</h1>
      <p>Liderando el futuro de la belleza digital</p>
    </div>
  </section>

  <!-- ====== CONTENIDO ====== -->
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