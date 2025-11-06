<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

include './includes/conexion.php';

$id = $_SESSION['usuario_id'];
$nombre = trim($_POST['nombre']);
$email = trim($_POST['email']);
$telefono = trim($_POST['telefono']);

// Validar campos vacíos
if (empty($nombre) || empty($email)) {
    echo "<script>alert('Por favor completa todos los campos obligatorios'); window.location.href='perfil.php';</script>";
    exit;
}

// Evitar duplicados de correo (si cambió)
$query = $conn->prepare("SELECT id FROM usuarios WHERE email = ? AND id != ?");
$query->bind_param("si", $email, $id);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    echo "<script>alert('❌ El correo ya está registrado por otro usuario'); window.location.href='perfil.php';</script>";
    exit;
}

// Actualizar datos
$update = $conn->prepare("UPDATE usuarios SET nombre = ?, email = ?, telefono = ? WHERE id = ?");
$update->bind_param("sssi", $nombre, $email, $telefono, $id);

if ($update->execute()) {
    echo "<script>alert('✅ Datos actualizados correctamente'); window.location.href='perfil.php';</script>";
} else {
    echo "<script>alert('❌ Error al actualizar el perfil'); window.location.href='perfil.php';</script>";
}
?>
