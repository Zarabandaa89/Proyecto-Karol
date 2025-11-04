<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión | Chic Royale</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(135deg, #ffd1dc, #ffb6c1, #ff69b4);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    header {
      background: rgba(255, 255, 255, 0.95);
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
      color: #ff69b4;
      font-size: 26px;
      font-weight: bold;
      text-decoration: none;
    }

    .back-btn {
      display: flex;
      align-items: center;
      gap: 8px;
      color: #ff69b4;
      text-decoration: none;
      font-size: 16px;
    }

    .login-container {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 40px 20px;
    }

    .login-box {
      background: white;
      border-radius: 20px;
      box-shadow: 0 15px 35px rgba(0,0,0,0.2);
      padding: 50px 40px;
      width: 100%;
      max-width: 450px;
    }

    .login-header {
      text-align: center;
      margin-bottom: 35px;
    }

    .login-header i {
      font-size: 60px;
      color: #ff69b4;
      margin-bottom: 15px;
    }

    .login-header h1 {
      color: #333;
      font-size: 28px;
      margin-bottom: 10px;
    }

    .login-header p {
      color: #999;
      font-size: 14px;
    }

    .form-group {
      margin-bottom: 25px;
    }

    .form-group label {
      display: block;
      color: #555;
      font-size: 14px;
      font-weight: 600;
      margin-bottom: 8px;
    }

    .input-wrapper {
      position: relative;
    }

    .input-wrapper i {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #ff69b4;
      font-size: 18px;
    }

    .form-group input {
      width: 100%;
      padding: 14px 15px 14px 45px;
      border: 2px solid #e0e0e0;
      border-radius: 10px;
      font-size: 15px;
      transition: all 0.3s;
      outline: none;
    }

    .form-group input:focus {
      border-color: #ff69b4;
      box-shadow: 0 0 0 3px rgba(255, 105, 180, 0.1);
    }

    .form-options {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
      font-size: 14px;
    }

    .remember-me {
      display: flex;
      align-items: center;
      gap: 8px;
      color: #666;
    }

    .remember-me input {
      width: 18px;
      height: 18px;
      cursor: pointer;
    }

    .forgot-password {
      color: #ff69b4;
      text-decoration: none;
    }

    .login-btn {
      width: 100%;
      padding: 15px;
      background: linear-gradient(135deg, #ff69b4, #ff1493);
      color: white;
      border: none;
      border-radius: 10px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.3s;
    }

    .login-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(255, 105, 180, 0.4);
    }

    .signup-link {
      text-align: center;
      margin-top: 25px;
      color: #666;
      font-size: 14px;
    }

    .signup-link a {
      color: #ff69b4;
      text-decoration: none;
      font-weight: bold;
    }

    .message {
      padding: 12px 15px;
      border-radius: 8px;
      margin-bottom: 20px;
      font-size: 14px;
      display: none;
    }

    .message.show {
      display: block;
    }

    .message.error {
      background: #fee;
      color: #c33;
      border: 1px solid #fcc;
    }

    .message.success {
      background: #efe;
      color: #3c3;
      border: 1px solid #cfc;
    }

    footer {
      background: rgba(255, 255, 255, 0.95);
      color: #666;
      text-align: center;
      padding: 20px;
    }
  </style>
</head>
<body>
  <header>
    <div class="barra-superior">
      <div class="logo">
        <a href="index.html">◉ Chic Royale</a>
      </div>
      <a href="index.html" class="back-btn">
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
        ¿No tienes cuenta? <a href="registro.html">Regístrate aquí</a>
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

        showMessage('✅ ¡Inicio de sesión exitoso! Redirigiendo...', 'success');
        
        setTimeout(function() {
          window.location.href = 'index.html';
        }, 1500);
      } else {
        showMessage('❌ Correo o contraseña incorrectos', 'error');
      }
    });

    const currentUser = localStorage.getItem('currentUser');
    if (currentUser) {
      window.location.href = 'index.html';
    }
  </script>
</body>
</html>