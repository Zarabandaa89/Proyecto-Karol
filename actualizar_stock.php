<?php
header('Content-Type: application/json'); 
include './includes/conexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_producto = intval($_POST['id']);

    // Restar 1 del stock
    $sql = "UPDATE productos_1 SET stock = stock - 1 WHERE id = ? AND stock > 0";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_producto);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo json_encode(["success" => true, "message" => "Stock actualizado"]);
    } else {
        echo json_encode(["success" => false, "message" => "Sin stock disponible"]);
    }

    $stmt->close();
    $conn->close();
}
?>
