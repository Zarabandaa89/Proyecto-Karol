let cart = JSON.parse(localStorage.getItem('cart')) || [];

function addToCart(productId) {
  const producto = productos.find(p => p.id === productId);
  const itemExistente = cart.find(item => item.id === productId);

  if (itemExistente) {
    itemExistente.cantidad++;
  } else {
    cart.push({ ...producto, cantidad: 1 });
  }

  localStorage.setItem('cart', JSON.stringify(cart));
  updateCart();
  showNotification('Producto agregado al carrito');
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
        <div class="cart-item-image"></div>
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
  if (item) {
    item.cantidad += change;
    if (item.cantidad <= 0) {
      removeFromCart(productId);
    } else {
      localStorage.setItem('cart', JSON.stringify(cart));
      updateCart();
    }
  }
}

function removeFromCart(productId) {
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
