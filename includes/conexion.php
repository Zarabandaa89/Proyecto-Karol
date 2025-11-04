<?php
$host = "localhost";
$usuario = "root"; 
$clave = "";       
$bd = "chic_royale";

$conexion = new mysqli($host, $usuario, $clave, $bd);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>

