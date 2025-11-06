<?php
session_start();

// Verifica si el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

include './includes/conexion.php';

// Obtener el ID del usuario en sesión
$id = $_SESSION['usuario_id'];

// Preparar la consulta para eliminar el usuario
$query = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
$query->bind_param("i", $id);

if ($query->execute()) {
    // Cerrar sesión después de eliminar la cuenta
    session_unset();
    session_destroy();

    // Redirigir al inicio con mensaje opcional
    header("Location: index.php?mensaje=cuenta_eliminada");
    exit;
} else {
    echo "❌ Error al eliminar la cuenta. Intenta nuevamente.";
}
?>
