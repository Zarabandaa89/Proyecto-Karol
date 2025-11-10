<?php
session_start();
include "./includes/conexion.php";

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$usuario_email = $_SESSION['usuario_email'];

$sql = "SELECT * FROM ventas WHERE email_cliente = ? ORDER BY fecha DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $usuario_email);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mis Pedidos | Chic Royale</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        body {
            background: #fdfdfd;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin: 30px 0;
            color: #e91e63;
        }

        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background: #e91e63;
            color: #fff;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        .sin-pedidos {
            text-align: center;
            font-size: 1.2em;
            margin-top: 50px;
            color: #777;
        }

        .volver {
            display: block;
            text-align: center;
            margin: 30px auto;
            color: #e91e63;
            text-decoration: none;
            font-weight: bold;
        }

        .volver:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <?php include "./includes/conexion.php"; ?>

    <h1>🛍️ Mis Pedidos</h1>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>Fecha</th>
                <th>Productos</th>
                <th>Método de Pago</th>
                <th>Total</th>
                <th>Comentarios</th>
            </tr>
            <?php while ($fila = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($fila['fecha']); ?></td>
                    <td>
                        <?php
                        $productos = json_decode($fila['productos'], true);
                        if ($productos) {
                            foreach ($productos as $p) {
                                $nombre = htmlspecialchars($p['nombre']);
                                $precio = number_format($p['precio'], 0, ',', '.');
                                echo "- $nombre ($$precio)<br>";
                            }
                        } else {
                            echo "Sin productos";
                        }
                        ?>
                    </td>
                    <td><?= htmlspecialchars($fila['metodo_pago']); ?></td>
                    <td>$<?= number_format($fila['total'], 0, ',', '.'); ?></td>
                    <td><?= htmlspecialchars($fila['comentarios']); ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p class="sin-pedidos">🕐 Aún no has realizado ningún pedido.</p>
    <?php endif; ?>

    <a href="index.php" class="volver"><i class="fa-solid fa-arrow-left"></i> Volver a la tienda</a>

</body>

</html>
<?php
$stmt->close();
$conn->close();
?>