<?php
include "../includes/conexion.php";

$accion = $_POST['accion'] ?? '';

switch ($accion) {

    case "listar":
        $sql = "SELECT * FROM productos ORDER BY id DESC";
        $res = $conexion->query($sql);

        $data = [];
        while ($row = $res->fetch_assoc()) {
            $data[] = $row;
        }

        echo json_encode($data);
    break;
    case "crear":
        $nombre = $_POST['nombre'];
        $categoria = $_POST['categoria'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $badge = $_POST['badge'];

        $sql = "INSERT INTO productos (nombre, categoria, precio, descripcion, badge)
                VALUES ('$nombre', '$categoria', '$precio', '$descripcion', '$badge')";

        echo ($conexion->query($sql)) 
            ? "success"
            : "error";
    break;

    case "editar":
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $categoria = $_POST['categoria'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $badge = $_POST['badge'];

        $sql = "UPDATE productos SET
                nombre='$nombre',
                categoria='$categoria',
                precio='$precio',
                descripcion='$descripcion',
                badge='$badge'
                WHERE id = $id";

        echo ($conexion->query($sql))
            ? "success"
            : "error";
    break;

    case "eliminar":
        $id = $_POST['id'];

        $sql = "DELETE FROM productos WHERE id = $id";

        echo ($conexion->query($sql))
            ? "success"
            : "error";
    break;
}
?>
