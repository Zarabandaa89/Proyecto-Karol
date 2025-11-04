<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Completar Pago | Chic Royale</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
</head>

<body>
  <header>
    <div class="barra-superior">
      <div class="logo">
        <div class="logo-icon">💄</div>
        <a href="index.html">Chic Royale</a>
      </div>
    </div>
  </header>

  <div class="checkout-container">
    <!-- BARRA DE PROGRESO -->
    <div class="progress-bar">
      <div class="progress-steps">
        <div class="progress-line"></div>
        <div class="step completed">
          <div class="step-circle"><i class="fa-solid fa-cart-shopping"></i></div>
          <div class="step-text">Carrito</div>
        </div>
        <div class="step active">
          <div class="step-circle"><i class="fa-solid fa-credit-card"></i></div>
          <div class="step-text">Pago</div>
        </div>
        <div class="step">
          <div class="step-circle"><i class="fa-solid fa-check"></i></div>
          <div class="step-text">Confirmación</div>
        </div>
      </div>
    </div>

    <!-- FORMULARIO -->
    <div class="checkout-form">
      <form id="checkoutForm">
        <!-- INFORMACIÓN DE ENVÍO -->
        <div class="form-section">
          <h2><i class="fa-solid fa-truck"></i> Información de Envío</h2>
          
          <div class="form-row">
            <div class="form-group">
              <label>Nombre Completo *</label>
              <input type="text" id="fullName" required>
            </div>
            <div class="form-group">
              <label>Teléfono *</label>
              <input type="tel" id="phone" required>
            </div>
          </div>

          <div class="form-group">
            <label>Dirección Completa *</label>
            <input type="text" id="address" required placeholder="Calle, número, apartamento...">
          </div>

          <div class="form-row">
            <div class="form-group">
              <label>Ciudad *</label>
              <input type="text" id="city" required>
            </div>
            <div class="form-group">
              <label>Código Postal</label>
              <input type="text" id="zipCode">
            </div>
          </div>

          <div class="form-group">
            <label>Notas de Entrega (Opcional)</label>
            <textarea id="notes" rows="3" placeholder="Ej: Dejar con el portero, Casa de color blanco..."></textarea>
          </div>
        </div>

        <!-- MÉTODO DE PAGO -->
        <div class="form-section">
          <h2><i class="fa-solid fa-credit-card"></i> Método de Pago</h2>
          
          <div class="payment-methods">
            <label class="payment-method active" data-method="card">
              <input type="radio" name="payment" value="card" checked>
              <i class="fa-solid fa-credit-card"></i>
              <div class="payment-info">
                <h4>Tarjeta de Crédito/Débito</h4>
                <p>Visa, Mastercard, American Express</p>
              </div>
            </label>

            <label class="payment-method" data-method="pse">
              <input type="radio" name="payment" value="pse">
              <i class="fa-solid fa-building-columns"></i>
              <div class="payment-info">
                <h4>PSE</h4>
                <p>Pago seguro electrónico</p>
              </div>
            </label>

            <label class="payment-method" data-method="cash">
              <input type="radio" name="payment" value="cash">
              <i class="fa-solid fa-money-bill-wave"></i>
              <div class="payment-info">
                <h4>Contra Entrega</h4>
                <p>Paga al recibir tu pedido</p>
              </div>
            </label>
          </div>

          <!-- DETALLES TARJETA -->
          <div class="card-details active" id="cardDetails">
            <div class="form-group">
              <label>Número de Tarjeta *</label>
              <input type="text" id="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19">
            </div>

            <div class="form-row">
              <div class="form-group">
                <label>Fecha de Expiración *</label>
                <input type="text" id="expiry" placeholder="MM/AA" maxlength="5">
              </div>
              <div class="form-group">
                <label>CVV *</label>
                <input type="text" id="cvv" placeholder="123" maxlength="4">
              </div>
            </div>

            <div class="form-group">
              <label>Nombre en la Tarjeta *</label>
              <input type="text" id="cardName" placeholder="Como aparece en la tarjeta">
            </div>
          </div>
        </div>
      </form>
    </div>

    <!-- RESUMEN -->
    <div class="order-summary">
      <h2><i class="fa-solid fa-receipt"></i> Resumen del Pedido</h2>
      
      <div id="summaryItems"></div>

      <div class="summary-totals">
        <div class="total-row">
          <span>Subtotal:</span>
          <span id="subtotalAmount">$0</span>
        </div>
        <div class="total-row">
          <span>Envío:</span>
          <span id="shippingAmount">$5.000</span>
        </div>
        <div class="total-final">
          <span>Total:</span>
          <span id="totalAmount">$0</span>
        </div>
      </div>

      <button class="submit-btn" id="submitOrder">
        <i class="fa-solid fa-lock"></i> Confirmar y Pagar
      </button>

      <div class="security-note">
        <i class="fa-solid fa-shield-halved"></i>
        <span>Tus datos están protegidos con encriptación SSL</span>
      </div>
    </div>
  </div>

  <!-- MODAL ÉXITO -->
  <div class="success-modal" id="successModal">
    <div class="success-content">
      <div class="success-icon">
        <i class="fa-solid fa-check"></i>
      </div>
      <h2>¡Pedido Confirmado!</h2>
      <p>Tu pedido ha sido procesado exitosamente.</p>
      <div class="order-number">
        Número de Pedido: <span id="orderNumber"></span>
      </div>
      <p>Recibirás un correo de confirmación con los detalles de tu compra.</p>
      
      <div class="success-buttons">
        <button class="success-btn primary" onclick="window.location.href='index.php'">
          <i class="fa-solid fa-home"></i> Volver al Inicio
        </button>
        <button class="success-btn secondary" onclick="window.location.href='pedidos.php'">
          <i class="fa-solid fa-box"></i> Ver Mis Pedidos
        </button>
      </div>
    </div>
  </div>

  <script>
    // ==========================================
    // CARGAR DATOS DEL PEDIDO
    // ==========================================
    
    function loadOrderData() {
      const orderData = localStorage.getItem('pendingOrder');
      if (!orderData) {
        alert('❌ No hay un pedido pendiente');
        window.location.href = 'index.php';
        return null;
      }
      return JSON.parse(orderData);
    }

    // ==========================================
    // RENDERIZAR RESUMEN
    // ==========================================
    
    function renderSummary() {
      const order = loadOrderData();
      if (!order) return;

      const summaryItems = document.getElementById('summaryItems');
      summaryItems.innerHTML = order.items.map(item => `
        <div class="summary-item">
          <div class="item-image">
            <img src="${item.image}" alt="${item.name}" onerror="this.parentElement.style.background='linear-gradient(135deg, #ffb6c1, #ff69b4)'">
          </div>
          <div class="item-details">
            <h4>${item.name}</h4>
            <p>Cantidad: ${item.quantity}</p>
          </div>
          <div class="item-price">
            $${(item.price * item.quantity).toLocaleString()}
          </div>
        </div>
      `).join('');

        const subtotal = order.items.reduce((sum, item) => sum + item.price * item.quantity, 0);
        document.getElementById('subtotalAmount').textContent = '$' + subtotal.toLocaleString();
        document.getElementById('totalAmount').textContent = '$' + (subtotal + 5000).toLocaleString();
    }

    // ==========================================
    // MÉTODOS DE PAGO
    // ==========================================
    
    document.querySelectorAll('.payment-method').forEach(method => {
      method.addEventListener('click', function() {
        document.querySelectorAll('.payment-method').forEach(m => m.classList.remove('active'));
        this.classList.add('active');
        this.querySelector('input').checked = true;

        const cardDetails = document.getElementById('cardDetails');
        if (this.dataset.method === 'card') {
          cardDetails.classList.add('active');
        } else {
          cardDetails.classList.remove('active');
        }
      });
    });

    // ==========================================
    // FORMATEAR CAMPOS
    // ==========================================
    
    // Formatear número de tarjeta
    const cardNumberInput = document.getElementById('cardNumber');
    if (cardNumberInput) {
      cardNumberInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\s/g, '').replace(/\D/g, '');
        let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
        e.target.value = formattedValue;
      });
    }

    // Formatear fecha de expiración
    const expiryInput = document.getElementById('expiry');
    if (expiryInput) {
      expiryInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length >= 2) {
          value = value.substring(0, 2) + '/' + value.substring(2, 4);
        }
        e.target.value = value;
      });
    }

    // Solo números en CVV
    const cvvInput = document.getElementById('cvv');
    if (cvvInput) {
      cvvInput.addEventListener('input', function(e) {
        e.target.value = e.target.value.replace(/\D/g, '');
      });
    }

    // ==========================================
    // CARGAR DATOS DEL USUARIO
    // ==========================================
    
    const currentUser = JSON.parse(localStorage.getItem('currentUser') || '{}');
    if (currentUser.name) {
      document.getElementById('fullName').value = currentUser.name;
    }

    // ==========================================
    // ENVIAR PEDIDO
    // ==========================================
    
    document.getElementById('submitOrder').addEventListener('click', function() {
      const form = document.getElementById('checkoutForm');
      
      // Validar campos requeridos
      const fullName = document.getElementById('fullName').value.trim();
      const phone = document.getElementById('phone').value.trim();
      const address = document.getElementById('address').value.trim();
      const city = document.getElementById('city').value.trim();

      if (!fullName || !phone || !address || !city) {
        alert('❌ Por favor completa todos los campos obligatorios');
        return;
      }

      const paymentMethod = document.querySelector('input[name="payment"]:checked').value;
      
      // Validar tarjeta si es el método seleccionado
      if (paymentMethod === 'card') {
        const cardNumber = document.getElementById('cardNumber').value.trim();
        const expiry = document.getElementById('expiry').value.trim();
        const cvv = document.getElementById('cvv').value.trim();
        const cardName = document.getElementById('cardName').value.trim();

        if (!cardNumber || !expiry || !cvv || !cardName) {
          alert('❌ Por favor completa todos los datos de la tarjeta');
          return;
        }

        if (cardNumber.replace(/\s/g, '').length < 13) {
          alert('❌ Número de tarjeta inválido');
          return;
        }

        if (!/^\d{2}\/\d{2}$/.test(expiry)) {
          alert('❌ Fecha de expiración inválida');
          return;
        }

        if (cvv.length < 3) {
          alert('❌ CVV inválido');
          return;
        }
      }

      // Simular procesamiento
      this.disabled = true;
      this.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Procesando pago...';

      setTimeout(() => {
        // Generar número de pedido
        const orderNumber = 'CR' + Date.now().toString().slice(-8);
        document.getElementById('orderNumber').textContent = orderNumber;

        // Guardar pedido en historial
        const order = loadOrderData();
        const orderHistory = JSON.parse(localStorage.getItem('orderHistory') || '[]');
        orderHistory.push({
          ...order,
          orderNumber,
          status: 'En proceso',
          statusColor: '#ff9800',
          shippingInfo: {
            name: fullName,
            phone: phone,
            address: address,
            city: city,
            zipCode: document.getElementById('zipCode').value,
            notes: document.getElementById('notes').value
          },
          paymentMethod: paymentMethod === 'card' ? 'Tarjeta' : paymentMethod === 'pse' ? 'PSE' : 'Contra Entrega'
        });
        localStorage.setItem('orderHistory', JSON.stringify(orderHistory));

        // Limpiar carrito y pedido pendiente
        localStorage.removeItem('chicRoyaleCart');
        localStorage.removeItem('pendingOrder');

        // Mostrar modal de éxito
        document.getElementById('successModal').classList.add('active');
      }, 2500);
    });

    // ==========================================
    // INICIALIZAR
    // ==========================================
    
    renderSummary();
  </script>
</body>
</html>