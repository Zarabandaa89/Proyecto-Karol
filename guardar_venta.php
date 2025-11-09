<?php
include "includes/conexion.php";
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $direccion = $_POST['direccion'] ?? '';
    $metodo = $_POST['metodo'] ?? '';
    $comentarios = $_POST['comentarios'] ?? '';
    $total = $_POST['total'] ?? 0;
    $productos = $_POST['productos'] ?? '[]'; 

    $sql = "INSERT INTO ventas (nombre_cliente, email_cliente, direccion, metodo_pago, comentarios, total, productos)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $nombre, $email, $direccion, $metodo, $comentarios, $total, $productos);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Venta registrada correctamente"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error al registrar la venta"]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Método no permitido"]);
}
