<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Iniciar Sesión | Chic Royale</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="css/inicio-sesion.css" />
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
    <div class="login-box" id="loginBox">
      <div class="login-header">
        <i class="fa-solid fa-user-circle"></i>
        <h1>¡Bienvenida de nuevo! 💄</h1>
        <p>Inicia sesión para continuar</p>
      </div>

      <div id="message" class="message"></div>

      <form id="loginForm">
        <div class="form-group">
          <label for="email">Correo Electrónico</label>
          <div class="input-wrapper">
            <i class="fa-solid fa-envelope"></i>
            <input type="email" id="email" name="email" placeholder="tu@email.com" required>
          </div>
        </div>

        <div class="form-group">
          <label for="password">Contraseña</label>
          <div class="input-wrapper">
            <i class="fa-solid fa-lock"></i>
            <input type="password" id="password" name="password" placeholder="••••••••" required>
          </div>
        </div>

        <div class="form-options">
          <label class="remember-me">
            <input type="checkbox" id="remember">
            <span>Recordarme</span>
          </label>
          <a href="#" class="forgot-password" id="forgotPassword">¿Olvidaste tu contraseña?</a>
        </div>

        <button type="submit" class="login-btn">Iniciar Sesión</button>
      </form>

      <div class="signup-link">
        ¿No tienes cuenta? <a href="Registro.php">Regístrate aquí</a>
      </div>
    </div>

    <!-- 🔹 Recuperar contraseña -->
    <div class="login-box" id="recoverBox" style="display:none;">
      <div class="login-header">
        <i class="fa-solid fa-lock"></i>
        <h1>Recuperar Contraseña</h1>
        <p>Ingresa tu correo electrónico para restablecer tu contraseña</p>
      </div>

      <form id="recoverForm">
        <div class="form-group">
          <label for="recoverEmail">Correo Electrónico</label>
          <div class="input-wrapper">
            <i class="fa-solid fa-envelope"></i>
            <input type="email" id="recoverEmail" required>
          </div>
        </div>

        <button type="submit" class="login-btn">Enviar enlace de recuperación</button>
      </form>

      <div class="back-to-login">
        <a href="#" id="backToLogin">Volver al inicio de sesión</a>
      </div>
    </div>
  </div>

  <footer>
    © 2025 Chic Royale - Todos los derechos reservados 💄
  </footer>

  <script>
    const loginForm = document.getElementById('loginForm');
    const messageDiv = document.getElementById('message');
    const forgotPasswordLink = document.getElementById('forgotPassword');
    const recoverBox = document.getElementById('recoverBox');
    const loginBox = document.getElementById('loginBox');
    const recoverForm = document.getElementById('recoverForm');
    const backToLoginLink = document.getElementById('backToLogin');

    function showMessage(text, type) {
      messageDiv.textContent = text;
      messageDiv.className = 'message ' + type + ' show';
      setTimeout(() => messageDiv.classList.remove('show'), 4000);
    }

    // 🔹 LOGIN PHP
    loginForm.addEventListener('submit', async function(e) {
      e.preventDefault();
      const formData = new FormData(loginForm);

      try {
        const response = await fetch('login-dos.php', {
          method: 'POST',
          body: formData
        });
        const data = await response.json();

        if (data.status === 'admin') {
          showMessage('👑 Bienvenido administrador', 'success');
          setTimeout(() => {
            window.location.href = 'admin/admin.login.php';
          }, 1200);
        } else if (data.status === 'success') {
          showMessage('✅ Inicio de sesión exitoso', 'success');
          setTimeout(() => {
            window.location.href = 'index.php';
          }, 1200);
        } else {
          showMessage('❌ ' + (data.message || 'Error al iniciar sesión'), 'error');
        }
      } catch (error) {
        showMessage('❌ Error de conexión con el servidor', 'error');
      }
    });

    // 🔹 Recuperación de contraseña
    forgotPasswordLink.addEventListener('click', (e) => {
      e.preventDefault();
      loginBox.style.display = 'none';
      recoverBox.style.display = 'block';
    });

    backToLoginLink.addEventListener('click', (e) => {
      e.preventDefault();
      recoverBox.style.display = 'none';
      loginBox.style.display = 'block';
    });

    recoverForm.addEventListener('submit', function(e) {
      e.preventDefault();
      const email = document.getElementById('recoverEmail').value.trim();
      if (!email) {
        showMessage('❌ Ingresa un correo válido', 'error');
        return;
      }
      showMessage('✅ Se envió un enlace de recuperación.', 'success');
    });
  </script>
</body>
</html>
