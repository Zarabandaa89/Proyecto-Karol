<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página Principal | Chic Royale</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/checkout.css">
</head>

<body>
  <header>
    <div class="barra-superior">
      <div class="logo">
        <div class="logo-icon">💄</div>
        <a href="index.php">Chic Royale</a>
      </div>

      <nav class="menu">
        <a href="index.php" onclick="scrollToTop(); return false;">Inicio</a>
        <a href="productos.php">Productos</a>
        <a href="mision.php">Misión</a>
        <a href="vision.php">Visión</a>
      </nav>

      <div class="iconos">
        <div class="user-menu">
          <div class="user-toggle" id="userToggle">
            <i class="fa-solid fa-user"></i>
          </div>

          <div class="dropdown-menu" id="dropdownMenu">
            <?php if (isset($_SESSION['usuario_id'])): ?>
              <div class="user-profile active" id="userProfile">
                <div class="dropdown-header">
                  <i class="fa-solid fa-user-circle"></i>
                  <h3><?= htmlspecialchars($_SESSION['usuario_nombre']); ?></h3>
                  <p><?= htmlspecialchars($_SESSION['usuario_email']); ?></p>
                </div>

                <div class="dropdown-links">
                  <a href="perfil.php"><i class="fa-solid fa-user"></i><span>Mi Perfil</span></a>
                  <a href="pedidos.php"><i class="fa-solid fa-box"></i><span>Mis Pedidos</span></a>
                  <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i><span>Cerrar Sesión</span></a>
                </div>
              </div>
            <?php else: ?>
              <div class="guest-links" id="guestLinks">
                <div class="dropdown-header">
                  <i class="fa-solid fa-user-circle"></i>
                  <h3>Bienvenido</h3>
                  <p>Inicia sesión o regístrate</p>
                </div>

                <div class="dropdown-links">
                  <a href="login.php"><i class="fa-solid fa-right-to-bracket"></i><span>Iniciar Sesión</span></a>
                  <a href="Registro.php"><i class="fa-solid fa-user-plus"></i><span>Registrarse</span></a>
                </div>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </header>

  <main class="checkout-container">
    <section class="checkout-products" id="checkoutProducts"></section>

    <section class="checkout-summary">
      <h2>Resumen del Pedido</h2>
      <div id="checkoutTotal">Total: $0</div>

      <button id="confirmPurchase" class="confirm-btn">
        <i class="fa-solid fa-credit-card"></i> Confirmar Pago
      </button>
    </section>
  </main>

  <div id="paymentModal" class="payment-modal">
    <div class="payment-content">
      <button class="close-modal" id="closeModal">&times;</button>
      <h2>Formulario de Pago</h2>
      <form id="paymentForm">
        <label>Nombre Completo</label>
        <input type="text" name="nombre" required>

        <label>Correo Electrónico</label>
        <input type="email" name="email" required>

        <label>Dirección de Envío</label>
        <input type="text" name="direccion" required>

        <label>Método de Pago</label>
        <select name="metodo" required>
          <option value="">Seleccione...</option>
          <option value="Tarjeta de Crédito">Tarjeta de Crédito</option>
          <option value="Nequi">Nequi</option>
          <option value="Daviplata">Daviplata</option>
          <option value="Contraentrega">Contraentrega</option>
        </select>

        <label>Comentarios (opcional)</label>
        <textarea name="comentarios" rows="3"></textarea>

        <button type="submit" class="btn-pagar">
          <i class="fa-solid fa-file-pdf"></i> Generar Comprobante PDF
        </button>
      </form>
    </div>
  </div>


  <footer>
    © 2025 Chic Royale - Todos los derechos reservados 💄
  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

  <script>
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const container = document.getElementById('checkoutProducts');
    const totalDiv = document.getElementById('checkoutTotal');

    if (cart.length === 0) {
      container.innerHTML = '<p class="empty">Tu carrito está vacío.</p>';
    } else {
      let total = 0;
      container.innerHTML = cart.map(item => {
        total += item.precio * item.cantidad;
        return `
        <div class="checkout-item">
          <img src="${item.imagen}" alt="${item.nombre}">
          <div>
            <h3>${item.nombre}</h3>
            <p>Cantidad: ${item.cantidad}</p>
            <p>Precio: $${item.precio.toLocaleString()}</p>
          </div>
        </div>
      `;
      }).join('');
      totalDiv.textContent = 'Total: $' + total.toLocaleString();
    }

    const modal = document.getElementById('paymentModal');
    const confirmBtn = document.getElementById('confirmPurchase');
    const closeModal = document.getElementById('closeModal');
    const paymentForm = document.getElementById('paymentForm');

    confirmBtn.addEventListener('click', () => {
      if (cart.length === 0) {
        alert("⚠️ Tu carrito está vacío.");
        return;
      }
      modal.classList.add('show');
    });

    closeModal.addEventListener('click', () => modal.classList.remove('show'));
    modal.addEventListener('click', e => {
      if (e.target === modal) modal.classList.remove('show');
    });

    paymentForm.addEventListener('submit', e => {
      e.preventDefault();
      const datos = Object.fromEntries(new FormData(paymentForm).entries());
      const total = cart.reduce((sum, item) => sum + item.precio * item.cantidad, 0);

      fetch("guardar_venta.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded"
          },
          body: new URLSearchParams({
            nombre: datos.nombre,
            email: datos.email,
            direccion: datos.direccion,
            metodo: datos.metodo,
            comentarios: datos.comentarios,
            total: total,
            productos: JSON.stringify(cart)
          })
        })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            console.log("✅ Venta guardada en la base de datos");
          } else {
            console.error("❌ Error al guardar venta:", data.message);
          }
        })
        .catch(err => console.error("Error al enviar venta:", err));

      const {
        jsPDF
      } = window.jspdf;
      const doc = new jsPDF();
      doc.setFontSize(18);
      doc.text("Comprobante de Compra - Chic Royale", 20, 20);
      doc.setFontSize(12);
      doc.text(`Nombre: ${datos.nombre}`, 20, 35);
      doc.text(`Correo: ${datos.email}`, 20, 42);
      doc.text(`Dirección: ${datos.direccion}`, 20, 49);
      doc.text(`Método de Pago: ${datos.metodo}`, 20, 56);
      if (datos.comentarios) doc.text(`Comentarios: ${datos.comentarios}`, 20, 63);
      doc.text("Detalle de la compra:", 20, 75);

      let y = 82;
      cart.forEach((item, i) => {
        doc.text(`${i + 1}. ${item.nombre} x${item.cantidad} - $${(item.precio * item.cantidad).toLocaleString()}`, 20, y);
        y += 7;
      });

      doc.setFontSize(14);
      doc.text(`Total: $${total.toLocaleString()}`, 20, y + 10);

      const fileName = `Comprobante_${datos.nombre.replace(/\s+/g, '_')}.pdf`;
      doc.save(fileName);

      localStorage.removeItem('cart');
      modal.classList.remove('show');
      alert("✅ ¡Compra registrada con éxito!");
      window.location.href = 'index.php';
    });
  </script>
  <script>
    const userToggle = document.getElementById("userToggle");
    const dropdownMenu = document.getElementById("dropdownMenu");
    const guestLinks = document.getElementById("guestLinks");
    const userProfile = document.getElementById("userProfile");
    const logoutBtn = document.getElementById("logoutBtn");

    userToggle.addEventListener("click", (e) => {
      e.stopPropagation();
      dropdownMenu.classList.toggle("open");
    });

    document.addEventListener("click", (e) => {
      if (!dropdownMenu.contains(e.target) && !userToggle.contains(e.target)) {
        dropdownMenu.classList.remove("open");
      }
    });
  </script>
  <script>
    window.productos = [
      <?php
      $sqlDest = "SELECT * FROM productos_1 WHERE destacado = 1";
      $destacados = $conn->query($sqlDest);
      while ($p = $destacados->fetch_assoc()) {
        echo "{
          id: " . $p['id'] . ",
          nombre: '" . addslashes($p['nombre_producto']) . "',
          precio: " . $p['precio'] . ",
          descripcion: '" . addslashes($p['descripcion']) . "',
          imagen: 'uploads/" . $p['imagen'] . "',
          categoria: '" . $p['categoria'] . "'
        },";
      }
      ?>
    ];
  </script>

  <script src="js/cart.js" defer></script>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      document.querySelectorAll(".add-to-cart").forEach(btn => {
        btn.addEventListener("click", () => {
          const id = parseInt(btn.dataset.id);
          addToCart(id);
        });
      });

      const checkoutBtn = document.getElementById('checkoutBtn');
      if (checkoutBtn) {
        checkoutBtn.addEventListener('click', () => {
          if (cart.length === 0) {
            alert("⚠️ Tu carrito está vacío.");
          } else {
            window.location.href = "checkout.php";
          }
        });
      }
    });
  </script>
</body>

</html>