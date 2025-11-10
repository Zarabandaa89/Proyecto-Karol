<?php
include "../includes/conexion.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['name'];
    $email = $_POST['email'];
    $telefono = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["status" => "error", "message" => "❌ Este correo ya está registrado"]);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, telefono, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nombre, $email, $telefono, $password);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "✅ Cuenta creada exitosamente"]);
    } else {
        echo json_encode(["status" => "error", "message" => "❌ Error al registrar el usuario"]);
    }

    $stmt->close();
    $conn->close();
}
