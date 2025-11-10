<?php
include "../includes/conexion.php";

$accion = $_POST['accion'] ?? '';

switch ($accion) {
  case "listar":
    $sql = "SELECT id, nombre, email, telefono, fecha_registro FROM usuarios ORDER BY id DESC";
    $res = $conn->query($sql);
    $data = [];
    while ($row = $res->fetch_assoc()) $data[] = $row;
    echo json_encode($data);
    break;

  case "contar":
    $sql = "SELECT COUNT(*) AS total FROM usuarios";
    $res = $conn->query($sql);
    $row = $res->fetch_assoc();
    echo $row['total'] ?? 0;
    break;

  default:
    echo json_encode([]);
    break;
}
