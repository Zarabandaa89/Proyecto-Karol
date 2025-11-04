<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión | Chic Royale</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="css\inicio-sesion.css">

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

      <form id="loginForm">
        <div class="form-group">
          <label for="email">Correo Electrónico</label>
          <div class="input-wrapper">
            <i class="fa-solid fa-envelope"></i>
            <input type="email" id="email" placeholder="tu@email.com" required>
          </div>
        </div>

        <div class="form-group">
          <label for="password">Contraseña</label>
          <div class="input-wrapper">
            <i class="fa-solid fa-lock"></i>
            <input type="password" id="password" placeholder="••••••••" required>
          </div>
        </div>

        <div class="form-options">
          <label class="remember-me">
            <input type="checkbox" id="remember">
            <span>Recordarme</span>
          </label>
          <a href="#" class="forgot-password">¿Olvidaste tu contraseña?</a>
        </div>

        <button type="submit" class="login-btn">
          Iniciar Sesión
        </button>
      </form>

      <div class="signup-link">
        ¿No tienes cuenta? <a href="Registro.php">Regístrate aquí</a>
      </div>
    </div>
  </div>

  <footer>
    © 2025 Chic Royale - Todos los derechos reservados 💄
  </footer>

  <script>
    const loginForm = document.getElementById('loginForm');
    const messageDiv = document.getElementById('message');

    function showMessage(text, type) {
      messageDiv.textContent = text;
      messageDiv.className = 'message ' + type + ' show';
      setTimeout(function() {
        messageDiv.classList.remove('show');
      }, 4000);
    }

    loginForm.addEventListener('submit', function(e) {
  e.preventDefault();

  const email = document.getElementById('email').value.trim();
  const password = document.getElementById('password').value;
  const remember = document.getElementById('remember').checked;

  if (!email || !password) {
    showMessage('❌ Por favor completa todos los campos', 'error');
    return;
  }

  let users = [];
  try {
    users = JSON.parse(localStorage.getItem('users')) || [];
  } catch (error) {
    users = [];
  }

  const user = users.find(function(u) {
    return u.email.toLowerCase() === email.toLowerCase() && u.password === password;
  });

  if (user) {
    const currentUser = {
      name: user.name,
      email: user.email,
      phone: user.phone || ''
    };

    localStorage.setItem('currentUser', JSON.stringify(currentUser));

    if (remember) {
      localStorage.setItem('rememberUser', 'true');
    }

    if (email.toLowerCase() === "admin@chicroyale.com") {
      showMessage('✅ ¡Inicio de sesión exitoso! Redirigiendo al panel de administración...', 'success');
      setTimeout(function() {
        window.location.href = 'admin.php'; 
      }, 1500);
    } else {
      showMessage('✅ ¡Inicio de sesión exitoso! Redirigiendo al inicio...', 'success');
      setTimeout(function() {
        window.location.href = 'index.php'; 
      }, 1500);
    }
  } else {
    showMessage('❌ Correo o contraseña incorrectos', 'error');
  }
});


    const currentUser = localStorage.getItem('currentUser');
    if (currentUser) {
      window.location.href = 'index.php';
    }
  </script>
</body>
</html>