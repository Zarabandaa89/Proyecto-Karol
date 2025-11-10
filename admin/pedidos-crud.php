<?php
include "../includes/conexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';

    if ($accion === 'listar') {
        $sql = "SELECT id, nombre_cliente, email_cliente, direccion, metodo_pago, comentarios, total, productos, fecha 
                FROM ventas 
                ORDER BY fecha DESC";

        $result = $conn->query($sql);
        $pedidos = [];

        while ($row = $result->fetch_assoc()) {
            $productos = json_decode($row['productos'], true);
            $productos_texto = '';

            if (is_array($productos)) {
                foreach ($productos as $p) {
                    $productos_texto .= $p['nombre'] . " (x" . ($p['cantidad'] ?? 1) . ") - $" . number_format($p['precio'], 0, ',', '.') . "<br>";
                }
            }

            $pedidos[] = [
                'id' => $row['id'],
                'cliente' => $row['nombre_cliente'],
                'email' => $row['email_cliente'],
                'direccion' => $row['direccion'],
                'metodo_pago' => $row['metodo_pago'],
                'comentarios' => $row['comentarios'] ?? '-',
                'total_formateado' => '$' . number_format($row['total'], 0, ',', '.'),
                'fecha' => $row['fecha'],
                'productos' => $productos_texto,
                'estado' => 'Completado'
            ];
        }

        echo json_encode($pedidos, JSON_UNESCAPED_UNICODE);
    }

    $conn->close();
}
