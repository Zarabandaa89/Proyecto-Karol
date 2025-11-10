<?php
include "../includes/conexion.php";

$accion = $_POST['accion'] ?? '';

switch ($accion) {

  case "listar":
    $sql = "SELECT * FROM productos_1 ORDER BY id DESC";
    $res = $conn->query($sql);
    $data = [];
    while ($row = $res->fetch_assoc()) {
      $row['precio_formateado'] = '$' . number_format($row['precio'], 0, ',', '.');
      $data[] = $row;
    }
    echo json_encode($data);
    break;

  case "crear":
    $nombre = $_POST['nombre_producto'];
    $categoria = $_POST['categoria'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $badge = $_POST['badge'];
    $destacado = isset($_POST['destacado']) ? intval($_POST['destacado']) : 0;


    $nombreImagen = "";
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
      $nombreImagen = time() . "_" . basename($_FILES["imagen"]["name"]);
      $rutaDestino = "../uploads/" . $nombreImagen;
      move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaDestino);
    }

    $sql = "INSERT INTO productos_1 (nombre_producto, categoria, precio, descripcion, badge, destacado, imagen)
            VALUES ('$nombre', '$categoria', '$precio', '$descripcion', '$badge', '$destacado', '$nombreImagen')";

    echo ($conn->query($sql)) ? "success" : "error";
    break;

  case "editar":
    $id = $_POST['id'];
    $nombre = $_POST['nombre_producto'];
    $categoria = $_POST['categoria'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $badge = $_POST['badge'];

    $destacado = isset($_POST['destacado']) && $_POST['destacado'] == "1" ? 1 : 0;

    $updateImagen = "";
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
      $nombreImagen = time() . "_" . basename($_FILES["imagen"]["name"]);
      $rutaDestino = "../uploads/" . $nombreImagen;
      move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaDestino);
      $updateImagen = ", imagen='$nombreImagen'";
    }

    $sql = "UPDATE productos_1 SET
            nombre_producto='$nombre',
            categoria='$categoria',
            precio='$precio',
            descripcion='$descripcion',
            badge='$badge',
            destacado='$destacado'
            $updateImagen
            WHERE id = $id";

    echo ($conn->query($sql)) ? "success" : "error";
    break;
}
