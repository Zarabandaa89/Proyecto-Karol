<?php
session_start();
include './includes/conexion.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['usuario_email'] = $user['email'];
            $_SESSION['usuario_nombre'] = $user['nombre'];

            $adminEmails = [
                "admin@chicroyale.com",
                "santiago@admin.com",
                "santiagoo@admin.com",
                "karol@admin.com",
                "karol@chicroyale.com",
                "san@admin.com"
            ];

            if (in_array(strtolower($email), $adminEmails)) {
                $_SESSION['es_admin'] = true;
                echo json_encode(["status" => "admin"]);
                exit;
            } else {
                $_SESSION['es_admin'] = false;
                echo json_encode(["status" => "success"]);
                exit;
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Contraseña incorrecta"]);
            exit;
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Usuario no encontrado"]);
        exit;
    }
} else {
    echo json_encode(["status" => "error", "message" => "Método no permitido"]);
    exit;
}
