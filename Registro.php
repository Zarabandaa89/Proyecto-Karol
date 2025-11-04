<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrarse | Chic Royale</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="css/registro.css">
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

  <div class="register-container">
    <div class="register-box">
      <div class="register-header">
        <i class="fa-solid fa-user-plus"></i>
        <h1>¡Únete a Chic Royale! 💋</h1>
        <p>Crea tu cuenta y descubre productos increíbles</p>
      </div>

      <div id="message" class="message"></div>

      <form id="registerForm">
        <div class="form-group">
          <label for="name">Nombre Completo</label>
          <div class="input-wrapper">
            <i class="fa-solid fa-user"></i>
            <input type="text" id="name" placeholder="María García" required minlength="3">
          </div>
        </div>

        <div class="form-group">
          <label for="email">Correo Electrónico</label>
          <div class="input-wrapper">
            <i class="fa-solid fa-envelope"></i>
            <input type="email" id="email" placeholder="tu@email.com" required>
          </div>
        </div>

        <div class="form-group">
          <label for="phone">Teléfono (Opcional)</label>
          <div class="input-wrapper">
            <i class="fa-solid fa-phone"></i>
            <input type="tel" id="phone" placeholder="+57 300 123 4567">
          </div>
        </div>

        <div class="form-group">
          <label for="password">Contraseña</label>
          <div class="input-wrapper">
            <i class="fa-solid fa-lock"></i>
            <input type="password" id="password" placeholder="Mínimo 6 caracteres" required minlength="6">
          </div>
        </div>

        <div class="form-group">
          <label for="confirmPassword">Confirmar Contraseña</label>
          <div class="input-wrapper">
            <i class="fa-solid fa-lock"></i>
            <input type="password" id="confirmPassword" placeholder="Repite tu contraseña" required>
          </div>
        </div>

        <label class="terms-checkbox">
          <input type="checkbox" id="terms" required>
          <span>
            Acepto los <a href="#">Términos y Condiciones</a> y la 
            <a href="#">Política de Privacidad</a>
          </span>
        </label>

        <button type="submit" class="register-btn">
          Crear Cuenta
        </button>
      </form>

      <div class="login-link">
        ¿Ya tienes cuenta? <a href="iniciosesion.php">Inicia sesión aquí</a>
      </div>
    </div>
  </div>

  <footer>
    © 2025 Chic Royale - Todos los derechos reservados 💄
  </footer>

  <script>
    const registerForm = document.getElementById('registerForm');
    const messageDiv = document.getElementById('message');

    function showMessage(text, type) {
      messageDiv.textContent = text;
      messageDiv.className = 'message ' + type + ' show';
      setTimeout(function() {
        messageDiv.classList.remove('show');
      }, 5000);
    }

    registerForm.addEventListener('submit', function(e) {
      e.preventDefault();

      const name = document.getElementById('name').value;
      const email = document.getElementById('email').value;
      const phone = document.getElementById('phone').value;
      const password = document.getElementById('password').value;
      const confirmPassword = document.getElementById('confirmPassword').value;
      const terms = document.getElementById('terms').checked;

      if (!terms) {
        showMessage('❌ Debes aceptar los términos y condiciones', 'error');
        return;
      }

      if (password !== confirmPassword) {
        showMessage('❌ Las contraseñas no coinciden', 'error');
        return;
      }

      if (password.length < 6) {
        showMessage('❌ La contraseña debe tener al menos 6 caracteres', 'error');
        return;
      }

      let users = [];
      try {
        users = JSON.parse(localStorage.getItem('users')) || [];
      } catch (error) {
        users = [];
      }

      if (users.some(function(u) { return u.email === email; })) {
        showMessage('❌ Este correo ya está registrado. Intenta iniciar sesión', 'error');
        return;
      }

      const newUser = {
        id: Date.now(),
        name: name,
        email: email,
        phone: phone,
        password: password,
        createdAt: new Date().toISOString()
      };

      users.push(newUser);
      localStorage.setItem('users', JSON.stringify(users));

      showMessage('✅ ¡Cuenta creada exitosamente! Redirigiendo a inicio de sesión...', 'success');

      setTimeout(function() {
        window.location.href = 'iniciosesion.php';
      }, 1500);
    });

    const currentUser = localStorage.getItem('currentUser');
    if (currentUser) {
      window.location.href = 'index.php';
    }
  </script>
</body>
</html>