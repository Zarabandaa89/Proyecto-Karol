let cart = JSON.parse(localStorage.getItem('cart')) || [];

function waitForProductos(callback) {
  if (typeof window.productos !== "undefined" && Array.isArray(window.productos)) {
    callback();
  } else {
    console.warn("⏳ Esperando a que se carguen los productos...");
    setTimeout(() => waitForProductos(callback), 100);
  }
}

function addToCart(productId) {
  waitForProductos(() => {
    const producto = window.productos.find(p => p.id === productId);
    if (!producto) {
      console.error("⚠️ Producto no encontrado:", productId);
      return;
    }

    const itemExistente = cart.find(item => item.id === productId);

    fetch("actualizar_stock.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: `id=${productId}`
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        if (itemExistente) {
          itemExistente.cantidad++;
        } else {
          cart.push({ ...producto, cantidad: 1 });
        }
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCart();
        showNotification('Producto agregado al carrito');
      } else {
        showNotification('Producto sin stock disponible');
      }
    })
    .catch(() => showNotification('Error al conectar con el servidor.'));
  });
}

function updateCart() {
  const cartItems = document.getElementById('cartItems');
  const cartCount = document.getElementById('cartCount');
  const cartTotal = document.getElementById('cartTotal');

  const totalItems = cart.reduce((sum, item) => sum + item.cantidad, 0);
  if (cartCount) cartCount.textContent = totalItems;

  if (!cartItems || !cartTotal) return;

  const totalPrice = cart.reduce((sum, item) => sum + (item.precio * item.cantidad), 0);
  cartTotal.textContent = '$' + totalPrice.toLocaleString();

  if (cart.length === 0) {
    cartItems.innerHTML = `
      <div class="cart-empty">
        <i class="fa-solid fa-shopping-cart"></i>
        <p>Tu carrito está vacío</p>
      </div>
    `;
  } else {
    cartItems.innerHTML = cart.map(item => `
      <div class="cart-item">
        <div class="cart-item-info">
          <div class="cart-item-name">${item.nombre}</div>
          <div class="cart-item-price">$${item.precio.toLocaleString()}</div>
          <div class="cart-item-controls">
            <button class="qty-btn" onclick="updateQuantity(${item.id}, -1)">-</button>
            <span class="cart-item-qty">${item.cantidad}</span>
            <button class="qty-btn" onclick="updateQuantity(${item.id}, 1)">+</button>
            <button class="remove-item" onclick="removeFromCart(${item.id})">
              <i class="fa-solid fa-trash"></i>
            </button>
          </div>
        </div>
      </div>
    `).join('');
  }
}

function updateQuantity(productId, change) {
  const item = cart.find(item => item.id === productId);
  if (!item) return;

  if (change < 0) {
    fetch("devolver_stock.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: `id=${productId}`
    });
  }

  if (change > 0) {
    fetch("actualizar_stock.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: `id=${productId}`
    });
  }

  item.cantidad += change;

  if (item.cantidad <= 0) {
    removeFromCart(productId);
  } else {
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCart();
  }
}

function removeFromCart(productId) {
  const removedItem = cart.find(item => item.id === productId);
  if (removedItem) {
    for (let i = 0; i < removedItem.cantidad; i++) {
      fetch("devolver_stock.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `id=${productId}`
      });
    }
  }

  cart = cart.filter(item => item.id !== productId);
  localStorage.setItem('cart', JSON.stringify(cart));
  updateCart();
}

function showNotification(message) {
  alert(message);
}

document.addEventListener("DOMContentLoaded", () => {
  const cartToggle = document.getElementById('cartToggle');
  const cartSidebar = document.getElementById('cartSidebar');
  const cartOverlay = document.getElementById('cartOverlay');
  const closeCart = document.getElementById('closeCart');

  if (cartToggle && cartSidebar && cartOverlay && closeCart) {
    cartToggle.addEventListener('click', () => {
      cartSidebar.classList.add('open');
      cartOverlay.classList.add('show');
    });

    closeCart.addEventListener('click', () => {
      cartSidebar.classList.remove('open');
      cartOverlay.classList.remove('show');
    });

    cartOverlay.addEventListener('click', () => {
      cartSidebar.classList.remove('open');
      cartOverlay.classList.remove('show');
    });
  }

  updateCart();
});
