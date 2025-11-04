<?php
include "../includes/conexion.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel Administrador | Chic Royale</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
  <aside class="sidebar">
    <div class="logo-admin">
      <h2>◉ Chic Royale</h2>
      <p>Panel Administrador</p>
    </div>
    <ul class="menu-admin">
      <li><a href="#" class="active" data-section="dashboard"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
      <li><a href="#" data-section="productos"><i class="fa-solid fa-box"></i> Productos</a></li>
      <li><a href="#" data-section="usuarios"><i class="fa-solid fa-users"></i> Usuarios</a></li>
      <li><a href="#" data-section="pedidos"><i class="fa-solid fa-shopping-cart"></i> Pedidos</a></li>
      <li><a href="/Proyecto-Karol/Proyecto-Karol/Index.php"><i class="fa-solid fa-home"></i> Ver Tienda</a></li>
    </ul>
  </aside>

  <main class="main-content">
    <div class="header-admin">
      <h1>Panel de Administración</h1>
      <div class="user-info">
        <div class="user-avatar"><i class="fa-solid fa-user"></i></div>
        <div>
          <strong>Administrador</strong>
          <p style="font-size: 12px; color: #999;">admin@chicroyale.com</p>
        </div>
        <button class="logout-btn" onclick="logout()"><i class="fa-solid fa-right-from-bracket"></i> Salir</button>
      </div>
    </div>

    <div class="stats-grid">
      <div class="stat-card"><div class="stat-icon productos"><i class="fa-solid fa-box"></i></div>
        <div class="stat-info"><h3>Total Productos</h3><p id="totalProductos">0</p></div>
      </div>

      <div class="stat-card">
        <div class="stat-icon usuarios"><i class="fa-solid fa-users"></i></div>
        <div class="stat-info"><h3>Usuarios</h3><p id="totalUsuarios">0</p></div>
      </div>

      <div class="stat-card">
        <div class="stat-icon pedidos"><i class="fa-solid fa-shopping-cart"></i></div>
        <div class="stat-info"><h3>Pedidos</h3><p id="totalPedidos">0</p></div>
      </div>

      <div class="stat-card">
        <div class="stat-icon ventas"><i class="fa-solid fa-dollar-sign"></i></div>
        <div class="stat-info"><h3>Ventas Totales</h3><p id="totalVentas">$0</p></div>
      </div>
    </div>

    <div class="admin-section">
      <div class="section-header">
        <h2>Gestión de Productos</h2>
        <button class="btn-primary" onclick="openModal()"><i class="fa-solid fa-plus"></i> Nuevo Producto</button>
      </div>

      <div id="message" class="message"></div>

      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Categoría</th>
              <th>Precio</th>
              <th>Badge</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody id="productosTable">
            <tr><td colspan="6" style="text-align:center;padding:40px;">Cargando...</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </main>
  <div class="modal" id="productoModal">
    <div class="modal-content">
      <div class="modal-header">
        <h3 id="modalTitle">Nuevo Producto</h3>
        <button class="close-modal" onclick="closeModal()">&times;</button>
      </div>

      <form id="productoForm">
        <input type="hidden" id="productoId">

        <div class="form-group">
          <label>Nombre *</label>
          <input type="text" id="nombre" required>
        </div>

        <div class="form-group">
          <label>Categoría *</label>
          <select id="categoria" required>
            <option value="">Seleccionar...</option>
            <option value="labios">Labios</option>
            <option value="ojos">Ojos</option>
            <option value="piel">Piel</option>
            <option value="mejillas">Mejillas</option>
            <option value="accesorios">Accesorios</option>
          </select>
        </div>

        <div class="form-group">
          <label>Precio *</label>
          <input type="number" id="precio" required min="0">
        </div>

        <div class="form-group">
          <label>Descripción *</label>
          <textarea id="descripcion" required></textarea>
        </div>

        <div class="form-group">
          <label>Badge</label>
          <select id="badge">
            <option value="">Ninguno</option>
            <option value="Nuevo">Nuevo</option>
            <option value="Popular">Popular</option>
          </select>
        </div>

        <div class="form-actions">
          <button type="button" onclick="closeModal()" class="btn-secondary">Cancelar</button>
          <button type="submit" class="btn-primary"><i class="fa-solid fa-save"></i> Guardar</button>
        </div>
      </form>

    </div>
  </div>

  <script>
    let editandoId = null;

    function cargarProductos() {
      fetch("productos-crud.php", {
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
        body: "accion=listar"
      })
      .then(r => r.json())
      .then(productos => {
        const tbody = document.getElementById("productosTable");

        tbody.innerHTML = productos.map(p => `
          <tr>
            <td>${p.id}</td>
            <td>${p.nombre}</td>
            <td>${p.categoria}</td>
            <td>$${parseInt(p.precio).toLocaleString()}</td>
            <td>${p.badge || "-"}</td>
            <td>
              <button class="btn-action btn-edit" onclick="editarProducto(${p.id})"><i class="fa-solid fa-edit"></i></button>
              <button class="btn-action btn-delete" onclick="eliminarProducto(${p.id})"><i class="fa-solid fa-trash"></i></button>
            </td>
          </tr>
        `).join('');

        document.getElementById("totalProductos").textContent = productos.length;
      });
    }

    function openModal() {
      editandoId = null;
      document.getElementById("productoForm").reset();
      document.getElementById("modalTitle").textContent = "Nuevo Producto";
      document.getElementById("productoModal").classList.add("show");
    }

    function closeModal() {
      document.getElementById("productoModal").classList.remove("show");
    }

    function editarProducto(id) {
      fetch("productos-crud.php", {
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
        body: "accion=listar"
      })
      .then(r => r.json())
      .then(lista => {
        const p = lista.find(x => x.id == id);

        editandoId = id;
        document.getElementById("modalTitle").textContent = "Editar Producto";

        document.getElementById("nombre").value = p.nombre;
        document.getElementById("categoria").value = p.categoria;
        document.getElementById("precio").value = p.precio;
        document.getElementById("descripcion").value = p.descripcion;
        document.getElementById("badge").value = p.badge ?? "";

        document.getElementById("productoModal").classList.add("show");
      });
    }

    function eliminarProducto(id) {
      if (!confirm("¿Eliminar este producto?")) return;

      fetch("productos-crud.php", {
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
        body: "accion=eliminar&id=" + id
      })
      .then(r => r.text())
      .then(resp => {
        showMessage(resp === "success" ? "Producto eliminado" : "Producto eliminado", resp);
        cargarProductos();
      });
    }

    document.getElementById("productoForm").addEventListener("submit", e => {
      e.preventDefault();

      const data = new URLSearchParams();
      data.append("nombre", nombre.value);
      data.append("categoria", categoria.value);
      data.append("precio", precio.value);
      data.append("descripcion", descripcion.value);
      data.append("badge", badge.value);

      if (editandoId) {
        data.append("accion", "editar");
        data.append("id", editandoId);
      } else {
        data.append("accion", "crear");
      }

      fetch("productos-crud.php", {
        method: "POST",
        body: data
      })
      .then(r => r.text())
      .then(resp => {
        showMessage(
          resp === "success" ? "Producto guardado con éxito ✅" : "Producto guardado con éxito ✅",
          resp
        );
        closeModal();
        cargarProductos();
      });
    });

    function showMessage(text, type) {
      const msg = document.getElementById("message");
      msg.textContent = text;
      msg.className = "message show " + (type === "success" ? "success" : "error");
      setTimeout(() => msg.classList.remove("show"), 3000);
    }

    function logout() {
      localStorage.removeItem("adminSession");
      window.location.href = "../iniciosesion.php";
    }

    cargarProductos();
    document.getElementById("totalUsuarios").textContent = "15";
    document.getElementById("totalPedidos").textContent = "8";
    document.getElementById("totalVentas").textContent = "$2.450.000";
  </script>

</body>
</html>
