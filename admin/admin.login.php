<?php
session_start();
include "../includes/conexion.php";

if (!isset($_SESSION['es_admin']) || $_SESSION['es_admin'] !== true) {
  header("Location: ../inicio-sesion.php");
  exit;
}

$admin_email = $_SESSION['usuario_email'] ?? 'admin@chicroyale.com';
$admin_nombre = $_SESSION['usuario_nombre'] ?? 'Administrador';
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Panel Administrador | Chic Royale</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link rel="stylesheet" href="../css/admin.css" />
</head>

<body>
  <aside class="sidebar">
    <div class="logo-admin">
      <h2>◉ Chic Royale</h2>
      <p>Panel Administrador</p>
    </div>
    <ul class="menu-admin">
      <li><a href="#" class="active" data-section="dashboard"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
      <li><a href="#" data-section="usuarios"><i class="fa-solid fa-users"></i> Usuarios</a></li>
      <li><a href="#" data-section="pedidos"><i class="fa-solid fa-shopping-cart"></i> Pedidos</a></li>
    </ul>
  </aside>

  <main class="main-content">
    <div class="header-admin">
      <h1>Panel de Administración</h1>
      <div class="user-info">
        <div class="user-avatar"><i class="fa-solid fa-user"></i></div>
        <div>
          <strong><?= htmlspecialchars($admin_nombre) ?></strong>
          <p style="font-size: 12px; color: #999;"><?= htmlspecialchars($admin_email) ?></p>
        </div>
        <button class="logout-btn" onclick="window.location.href='admin.logout.php'">
          <i class="fa-solid fa-right-from-bracket"></i> Salir
        </button>
      </div>
    </div>

    <div class="stats-grid">
      <div class="stat-card">
        <div class="stat-icon productos"><i class="fa-solid fa-box"></i></div>
        <div class="stat-info">
          <h3>Total Productos</h3>
          <p id="totalProductos">0</p>
        </div>
      </div>

      <div class="stat-card">
        <div class="stat-icon usuarios"><i class="fa-solid fa-users"></i></div>
        <div class="stat-info">
          <h3>Usuarios</h3>
          <p id="totalUsuarios">0</p>
        </div>
      </div>

      <div class="stat-card">
        <div class="stat-icon pedidos"><i class="fa-solid fa-shopping-cart"></i></div>
        <div class="stat-info">
          <h3>Pedidos</h3>
          <p id="totalPedidos">0</p>
        </div>
      </div>

      <div class="stat-card">
        <div class="stat-icon ventas"><i class="fa-solid fa-dollar-sign"></i></div>
        <div class="stat-info">
          <h3>Ventas Totales</h3>
          <p id="totalVentas">$0</p>
        </div>
      </div>
    </div>

    <div class="admin-section" id="productosSection">
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
              <th>Imagen</th>
              <th>Nombre</th>
              <th>Categoría</th>
              <th>Precio</th>
              <th>Badge</th>
              <th>Acciones</th>
              <th>Destacado</th>
            </tr>
          </thead>
          <tbody id="productosTable">
            <tr>
              <td colspan="8" style="text-align:center;padding:40px;">Cargando...</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="admin-section" id="usuariosSection" style="display:none;">
      <div class="section-header">
        <h2>Lista de Usuarios Registrados</h2>
      </div>

      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Teléfono</th>
              <th>Fecha de Registro</th>
            </tr>
          </thead>
          <tbody id="usuariosTable">
            <tr>
              <td colspan="5" style="text-align:center;padding:40px;">Cargando...</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="admin-section" id="pedidosSection" style="display:none;">
      <div class="section-header">
        <h2>Lista de Pedidos</h2>
      </div>

      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Cliente</th>
              <th>Email</th>
              <th>Método Pago</th>
              <th>Productos</th>
              <th>Total</th>
              <th>Fecha</th>
            </tr>
          </thead>
          <tbody id="pedidosTable">
            <tr>
              <td colspan="7" style="text-align:center;padding:40px;">Cargando...</td>
            </tr>
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

      <form id="productoForm" enctype="multipart/form-data">
        <input type="hidden" id="productoId" />

        <div class="form-group">
          <label>Nombre *</label>
          <input type="text" id="nombre" required />
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
          <input type="number" id="precio" required min="0" />
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

        <div class="form-group">
          <label>Imagen del producto</label>
          <input type="file" id="imagen" accept="image/*" />
        </div>

        <div class="form-group">
          <label for="destacado">Destacado</label>
          <input type="hidden" name="destacado" value="0" />
          <input type="checkbox" id="destacado" name="destacado" value="1" />
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
          headers: {
            "Content-Type": "application/x-www-form-urlencoded"
          },
          body: "accion=listar"
        })
        .then(r => r.json())
        .then(productos => {
          const tbody = document.getElementById("productosTable");
          if (!Array.isArray(productos)) {
            tbody.innerHTML = `<tr><td colspan="8" style="text-align:center;padding:40px;">No se encontraron productos</td></tr>`;
            return;
          }
          tbody.innerHTML = productos.map(p => `
            <tr>
              <td>${p.id}</td>
              <td><img src="../uploads/${p.imagen || 'placeholder.png'}" width="60" height="60" style="object-fit:cover;border-radius:6px"></td>
              <td>${p.nombre_producto}</td>
              <td>${p.categoria}</td>
              <td>${p.precio_formateado}</td>
              <td>${p.badge || "-"}</td>
              <td>
                <button class="btn-action btn-edit" onclick="editarProducto(${p.id})"><i class="fa-solid fa-edit"></i></button>
                <button class="btn-action btn-delete" onclick="eliminarProducto(${p.id})"><i class="fa-solid fa-trash"></i></button>
              </td>
              <td>${p.destacado == 1 ? "✅ Sí" : "❌ No"}</td>
            </tr>
          `).join('');
          document.getElementById("totalProductos").textContent = productos.length;
        })
        .catch(err => console.error("Error cargarProductos:", err));
    }

    function cargarUsuariosCount() {
      fetch("usuarios-crud.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded"
          },
          body: "accion=contar"
        })
        .then(r => r.text())
        .then(total => document.getElementById("totalUsuarios").textContent = total)
        .catch(err => console.error("Error contar usuarios:", err));
    }

    function cargarListaUsuarios() {
      fetch("usuarios-crud.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded"
          },
          body: "accion=listar"
        })
        .then(r => r.json())
        .then(usuarios => {
          const tbody = document.getElementById("usuariosTable");
          if (!Array.isArray(usuarios)) {
            tbody.innerHTML = `<tr><td colspan="5" style="text-align:center;padding:40px;">No se encontraron usuarios</td></tr>`;
            return;
          }
          tbody.innerHTML = usuarios.map(u => `
            <tr>
              <td>${u.id}</td>
              <td>${u.nombre}</td>
              <td>${u.email}</td>
              <td>${u.telefono || '-'}</td>
              <td>${u.fecha_registro || '-'}</td>
            </tr>
          `).join('');
        })
        .catch(err => console.error("Error cargarListaUsuarios:", err));
    }

    function cargarPedidos() {
      fetch("pedidos-crud.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded"
          },
          body: "accion=listar"
        })
        .then(r => r.json())
        .then(pedidos => {
          const tbody = document.getElementById("pedidosTable");
          if (!Array.isArray(pedidos)) {
            tbody.innerHTML = `<tr><td colspan="7" style="text-align:center;padding:40px;">No se encontraron pedidos</td></tr>`;
            return;
          }

          tbody.innerHTML = pedidos.map(p => `
        <tr>
          <td>${p.id}</td>
          <td>${p.cliente}</td>
          <td>${p.email}</td>
          <td>${p.metodo_pago}</td>
          <td>${p.productos}</td>
          <td>${p.total_formateado}</td>
          <td>${p.fecha}</td>
        </tr>
      `).join('');
          document.getElementById("totalPedidos").textContent = pedidos.length;
        })
        .catch(err => console.error("Error cargarPedidos:", err));
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
          headers: {
            "Content-Type": "application/x-www-form-urlencoded"
          },
          body: "accion=listar"
        })
        .then(r => r.json())
        .then(lista => {
          const p = lista.find(x => x.id == id);
          if (!p) return alert("Producto no encontrado");
          editandoId = id;
          document.getElementById("modalTitle").textContent = "Editar Producto";
          document.getElementById("nombre").value = p.nombre_producto;
          document.getElementById("categoria").value = p.categoria;
          document.getElementById("precio").value = p.precio;
          document.getElementById("descripcion").value = p.descripcion;
          document.getElementById("badge").value = p.badge ?? "";
          document.getElementById("destacado").checked = p.destacado == 1;
          document.getElementById("productoModal").classList.add("show");
        });
    }

    function eliminarProducto(id) {
      if (!confirm("¿Eliminar este producto?")) return;
      fetch("productos-crud.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded"
          },
          body: "accion=eliminar&id=" + id
        })
        .then(r => r.text())
        .then(resp => {
          showMessage(resp === "success" ? "Producto eliminado ✅" : "Error al eliminar ❌", resp);
          cargarProductos();
        });
    }

    document.getElementById("productoForm").addEventListener("submit", e => {
      e.preventDefault();
      const formData = new FormData();
      formData.append("nombre_producto", document.getElementById("nombre").value);
      formData.append("categoria", document.getElementById("categoria").value);
      formData.append("precio", document.getElementById("precio").value);
      formData.append("descripcion", document.getElementById("descripcion").value);
      formData.append("badge", document.getElementById("badge").value);
      formData.append("destacado", document.getElementById("destacado").checked ? "1" : "0");
      const imagenFile = document.getElementById("imagen").files[0];
      if (imagenFile) formData.append("imagen", imagenFile);
      formData.append("accion", editandoId ? "editar" : "crear");
      if (editandoId) formData.append("id", editandoId);

      fetch("productos-crud.php", {
          method: "POST",
          body: formData
        })
        .then(r => r.text())
        .then(resp => {
          showMessage(resp === "success" ? "Producto guardado con éxito ✅" : "Error al guardar ❌", resp);
          closeModal();
          cargarProductos();
          cargarUsuariosCount();
        })
        .catch(err => console.error("Error al guardar:", err));
    });

    function showMessage(text, type) {
      const msg = document.getElementById("message");
      msg.textContent = text;
      msg.className = "message show " + (type === "success" ? "success" : "error");
      setTimeout(() => msg.classList.remove("show"), 3000);
    }

    document.querySelectorAll(".menu-admin a").forEach(link => {
      link.addEventListener("click", e => {
        e.preventDefault();
        document.querySelectorAll(".menu-admin a").forEach(a => a.classList.remove("active"));
        link.classList.add("active");
        const section = link.getAttribute("data-section");

        document.getElementById("productosSection").style.display = "none";
        document.getElementById("usuariosSection").style.display = "none";
        document.getElementById("pedidosSection").style.display = "none";

        if (section === "dashboard") {
          document.getElementById("productosSection").style.display = "block";
        } else if (section === "usuarios") {
          document.getElementById("usuariosSection").style.display = "block";
          cargarListaUsuarios();
        } else if (section === "pedidos") {
          document.getElementById("pedidosSection").style.display = "block";
          cargarPedidos();
        }
      });
    });

    cargarProductos();
    cargarUsuariosCount();
    cargarPedidos();
    document.getElementById("totalVentas").textContent = "$2.450.000";
  </script>
</body>

</html>