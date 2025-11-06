<?php
header('Content-Type: application/json'); 
include './includes/conexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_producto = intval($_POST['id']);

    $sql = "UPDATE productos_1 SET stock = stock + 1 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_producto);
    $stmt->execute();

    echo json_encode(["success" => $stmt->affected_rows > 0]);
    $stmt->close();
    $conn->close();
}
?>
