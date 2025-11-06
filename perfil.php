<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

include './includes/conexion.php';

$id = $_SESSION['usuario_id'];
$query = $conn->prepare("SELECT nombre, email, telefono FROM usuarios WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mi Perfil | Chic Royale</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="css/perfil.css">
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
        <a href="perfil.php">Mi Perfil</a>
      </nav>
    </div>
  </header>

  <div class="container">
    <div class="profile-card">
      <div class="profile-header">
        <div class="avatar">
          <i class="fa-solid fa-user"></i>
        </div>
        <h1><?= htmlspecialchars($user['nombre']) ?></h1>
        <p><?= htmlspecialchars($user['email']) ?></p>
      </div>

      <h2 class="section-title">
        <i class="fa-solid fa-user-pen"></i>
        Información Personal
      </h2>

      <form action="actualizar_perfil.php" method="POST">
        <div class="info-group">
          <label>Nombre Completo</label>
          <input type="text" name="nombre" value="<?= htmlspecialchars($user['nombre']) ?>" required>
        </div>

        <div class="info-group">
          <label>Correo Electrónico</label>
          <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
        </div>

        <div class="info-group">
          <label>Teléfono</label>
          <input type="tel" name="telefono" value="<?= htmlspecialchars($user['telefono']) ?>" placeholder="+57 300 123 4567">
        </div>

        <button type="submit" class="btn btn-primary">
          <i class="fa-solid fa-save"></i>
          Guardar Cambios
        </button>
      </form>

      <div class="danger-zone">
        <h3>
          <i class="fa-solid fa-triangle-exclamation"></i>
          Zona Peligrosa
        </h3>
        <p>Cerrar sesión o eliminar tu cuenta permanentemente</p>
        
        <a href="logout.php" class="btn btn-primary">
          <i class="fa-solid fa-right-from-bracket"></i>
          Cerrar Sesión
        </a>

        <form action="eliminar_cuenta.php" method="POST" onsubmit="return confirm('⚠ ¿Estás seguro de que quieres eliminar tu cuenta? Esta acción no se puede deshacer.');">
          <button type="submit" class="btn btn-danger">
            <i class="fa-solid fa-trash"></i>
            Eliminar Cuenta
          </button>
        </form>
      </div>
    </div>
  </div>

  <footer>
    © 2025 Chic Royale - Todos los derechos reservados 💄
  </footer>
</body>
</html>
