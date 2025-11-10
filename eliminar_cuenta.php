<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

include './includes/conexion.php';

$id = $_SESSION['usuario_id'];

$query = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
$query->bind_param("i", $id);

if ($query->execute()) {
    session_unset();
    session_destroy();

    header("Location: index.php?mensaje=cuenta_eliminada");
    exit;
} else {
    echo "❌ Error al eliminar la cuenta. Intenta nuevamente.";
}
