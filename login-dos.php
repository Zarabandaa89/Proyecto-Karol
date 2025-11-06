<?php
session_start();
include "includes/conexion.php";

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = strtolower(trim($_POST["email"]));
    $password = trim($_POST["password"]);

    // Buscar el usuario en la base de datos
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $usuario = $result->fetch_assoc();

        // Verificar contraseña
        if (password_verify($password, $usuario["password"])) {

            // Guardar variables de sesión
            $_SESSION["usuario_id"] = $usuario["id"];
            $_SESSION["usuario_nombre"] = $usuario["nombre"];
            $_SESSION["usuario_email"] = $usuario["email"];

            // Lista de administradores
            $adminEmails = [
                "admin@chicroyale.com",
                "santiago@admin.com",
                "santiagoo@admin.com",
                "karol@admin.com",
                "karol@chicroyale.com"
            ];

            // Si es admin
            if (in_array($usuario["email"], $adminEmails)) {
                $_SESSION["es_admin"] = true;
                echo json_encode(["status" => "admin"]);
                exit;
            }

            // Si es usuario normal
            $_SESSION["es_admin"] = false;
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Contraseña incorrecta"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Usuario no encontrado"]);
    }
}
