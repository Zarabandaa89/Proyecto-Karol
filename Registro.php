<?php
include './includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  header('Content-Type: application/json');

  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $phone = trim($_POST['phone']);
  $password = $_POST['password'];

  // Validar campos obligatorios
  if (empty($name) || empty($email) || empty($password)) {
    echo json_encode(["status" => "error", "message" => "❌ Faltan campos obligatorios"]);
    exit;
  }

  // Verificar si el correo ya está registrado
  $check = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
  $check->bind_param("s", $email);
  $check->execute();
  $result = $check->get_result();

  if ($result->num_rows > 0) {
    echo json_encode(["status" => "error", "message" => "❌ Este correo ya está registrado"]);
    $check->close();
    $conn->close();
    exit;
  }

  // Encriptar contraseña
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Insertar nuevo usuario
  $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, telefono, password, fecha_registro) VALUES (?, ?, ?, ?, NOW())");
  $stmt->bind_param("ssss", $name, $email, $phone, $hashedPassword);

  if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "✅ ¡Cuenta creada exitosamente!"]);
  } else {
    echo json_encode(["status" => "error", "message" => "❌ Error al registrar usuario"]);
  }

  $stmt->close();
  $conn->close();
  exit;
}
?>

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
        ¿Ya tienes cuenta? <a href="inicio-sesion.php">Inicia sesión aquí</a>
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
      setTimeout(() => messageDiv.classList.remove('show'), 5000);
    }

    registerForm.addEventListener('submit', async (e) => {
      e.preventDefault();

      const name = document.getElementById('name').value.trim();
      const email = document.getElementById('email').value.trim();
      const phone = document.getElementById('phone').value.trim();
      const password = document.getElementById('password').value;
      const confirmPassword = document.getElementById('confirmPassword').value;
      const terms = document.getElementById('terms').checked;

      if (!terms) return showMessage('❌ Debes aceptar los términos y condiciones', 'error');
      if (password !== confirmPassword) return showMessage('❌ Las contraseñas no coinciden', 'error');
      if (password.length < 6) return showMessage('❌ La contraseña debe tener al menos 6 caracteres', 'error');

      const formData = new FormData();
      formData.append('name', name);
      formData.append('email', email);
      formData.append('phone', phone);
      formData.append('password', password);

      try {
        const res = await fetch('Registro.php', {
          method: 'POST',
          body: formData
        });
        const data = await res.json();

        showMessage(data.message, data.status);

        if (data.status === 'success') {
          setTimeout(() => window.location.href = 'inicio-sesion.php', 1500);
        }
      } catch (err) {
        showMessage('❌ Error al conectar con el servidor', 'error');
      }
    });
  </script>

</body>

</html>