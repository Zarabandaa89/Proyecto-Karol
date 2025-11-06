<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Iniciar Sesión | Chic Royale</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="css/login.css" />
</head>

<body>
  <header>
    <div class="barra-superior">
      <div class="logo">
        <a href="index.php">◉ Chic Royale</a>
      </div>
      <a href="index.php" class="back-btn">
        <i class="fa-solid fa-arrow-left"></i>
        Volver al inicio
      </a>
    </div>
  </header>

  <div class="login-container">
    <div class="login-box">
      <div class="login-header">
        <i class="fa-solid fa-user-circle"></i>
        <h1>¡Bienvenida de nuevo! 💄</h1>
        <p>Inicia sesión para continuar</p>
      </div>

      <div id="message" class="message"></div>

      <form id="loginForm" method="post" action="#">
        <div class="form-group">
          <label for="email">Correo Electrónico</label>
          <div class="input-wrapper">
            <i class="fa-solid fa-envelope"></i>
            <input 
              type="email" 
              id="email" 
              name="email" 
              placeholder="tu@email.com"
              required
            />
          </div>
        </div>

        <div class="form-group">
          <label for="password">Contraseña</label>
          <div class="input-wrapper">
            <i class="fa-solid fa-lock"></i>
            <input 
              type="password" 
              id="password" 
              name="password" 
              placeholder="••••••••"
              required
            />
          </div>
        </div>

        <div class="form-options">
          <label class="remember-me">
            <input type="checkbox" id="remember" />
            <span>Recordarme</span>
          </label>
          <a href="#" class="forgot-password">¿Olvidaste tu contraseña?</a>
        </div>

        <button type="submit" class="login-btn">
          <i class="fa-solid fa-right-to-bracket"></i> Iniciar Sesión
        </button>
      </form>

      <div class="divider">o continúa con</div>

      <div class="social-login">
        <button class="social-btn google-btn">
          <i class="fa-brands fa-google"></i>
          Google
        </button>
        <button class="social-btn facebook-btn">
          <i class="fa-brands fa-facebook-f"></i>
          Facebook
        </button>
      </div>

      <div class="signup-link">
        ¿No tienes cuenta? <a href="Registro.php">Regístrate aquí</a>
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

    if (userToggle) {
      userToggle.addEventListener("click", (e) => {
        e.stopPropagation();
        dropdownMenu.classList.toggle("open");
      });

      document.addEventListener("click", (e) => {
        if (!dropdownMenu.contains(e.target) && !userToggle.contains(e.target)) {
          dropdownMenu.classList.remove("open");
        }
      });
    }

    function checkLoginStatus() {
      const user = JSON.parse(localStorage.getItem('currentUser'));
      if (user) {
        guestLinks?.classList.add('hidden');
        userProfile?.classList.add('active');
        document.getElementById('userName')?.textContent = user.name || 'Usuario';
        document.getElementById('userEmail')?.textContent = user.email || '';
      } else {
        guestLinks?.classList.remove('hidden');
        userProfile?.classList.remove('active');
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
  const loginForm = document.getElementById('loginForm');
  const messageDiv = document.getElementById('message');

  function showMessage(text, type) {
    messageDiv.textContent = text;
    messageDiv.className = `message ${type} show`;
    setTimeout(() => messageDiv.classList.remove('show'), 4000);
  }

  loginForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = new FormData(loginForm);

    try {
      const response = await fetch('./login-dos.php', {
        method: 'POST',
        body: formData
      });

      const data = await response.json();

      if (data.status === 'success') {
        showMessage('✅ ¡Inicio de sesión exitoso! Redirigiendo...', 'success');
        setTimeout(() => window.location.href = 'index.php', 1500);
      } else {
        showMessage('❌ ' + (data.message || 'Error al iniciar sesión'), 'error');
      }
    } catch (error) {
      showMessage('❌ Error de conexión con el servidor', 'error');
      console.error(error);
    }
  });
</script>


</body>
</html>
