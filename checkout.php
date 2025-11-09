<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout | Chic Royale</title>
  <link rel="stylesheet" href="css/checkout.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
  <header>
    <div class="checkout-header">
      <a href="index.php" class="logo">◉ Chic Royale</a>
      <h1>Resumen de Compra</h1>
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

  <footer>
    © 2025 Chic Royale - Todos los derechos reservados 💄
  </footer>

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

    const { jsPDF } = window.jspdf;
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
</body>
</html>
