<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Productos | Chic Royale</title>
  <link rel="stylesheet" href="css/estilos.css">
  <script src="https://kit.fontawesome.com/a2e0e6c6f6.js" crossorigin="anonymous"></script>
</head>
<body>
  <?php include 'includes/header.php'; ?>

  <main>
    <h1 class="titulo">✨ Nuestros Productos ✨</h1>
    <div class="productos-grid">
      <div class="producto">
        <img src="imagenes/labial-rosa.png" alt="Labial Rosa">
        <h3>Labial Rosa Chic</h3>
        <p>$25.000 COP</p>
        <button onclick="addToCartJS({nombre:'Labial Rosa Chic', precio:25000, cantidad:1})">Agregar al carrito</button>
      </div>
      <div class="producto">
        <img src="imagenes/rubor.png" alt="Rubor">
        <h3>Rubor Suave</h3>
        <p>$30.000 COP</p>
        <button onclick="addToCartJS({nombre:'Rubor Suave', precio:30000, cantidad:1})">Agregar al carrito</button>
      </div>
      <div class="producto">
        <img src="imagenes/sombra.png" alt="Sombra">
        <h3>Paleta Natural</h3>
        <p>$45.000 COP</p>
        <button onclick="addToCartJS({nombre:'Paleta Natural', precio:45000, cantidad:1})">Agregar al carrito</button>
      </div>
    </div>
  </main>

  <?php include 'includes/footer.php'; ?>
  <script src="js/main.js"></script>
  <script src="js/cart.js"></script>
</body>
</html>
