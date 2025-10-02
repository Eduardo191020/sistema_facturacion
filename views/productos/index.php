<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos - Frenos y Embragues Neko</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #64748b;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f8fafc;
        }

        .navbar {
            background-color: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color) !important;
            font-size: 1.25rem;
        }

        .nav-link {
            color: var(--secondary-color) !important;
            font-weight: 500;
            margin: 0 0.5rem;
            transition: color 0.2s;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary-color) !important;
        }

        .main-container {
            padding: 2rem 0;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 0.625rem 1.25rem;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
            transform: translateY(-1px);
        }

        .search-section {
            background: white;
            padding: 1.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
        }

        .search-input {
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 0.625rem 1rem;
            padding-left: 2.5rem;
        }

        .search-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary-color);
        }

        .filter-tabs {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .filter-tab {
            padding: 0.5rem 1rem;
            border: 1px solid #e2e8f0;
            background: white;
            color: var(--secondary-color);
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.2s;
            font-weight: 500;
        }

        .filter-tab:hover {
            background: #f1f5f9;
        }

        .filter-tab.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .table-container {
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background-color: #f8fafc;
            color: var(--secondary-color);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            padding: 1rem;
            border-bottom: 2px solid #e2e8f0;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            color: #334155;
        }

        .table tbody tr {
            border-bottom: 1px solid #f1f5f9;
            transition: background-color 0.2s;
        }

        .table tbody tr:hover {
            background-color: #f8fafc;
        }

        .badge {
            padding: 0.375rem 0.75rem;
            font-weight: 600;
            border-radius: 0.375rem;
            font-size: 0.75rem;
        }

        .badge-success {
            background-color: #dcfce7;
            color: #166534;
        }

        .badge-danger {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .stock-alert {
            color: var(--danger-color);
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .stock-ok {
            color: var(--success-color);
        }

        .btn-action {
            width: 2rem;
            height: 2rem;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.375rem;
            border: none;
            transition: all 0.2s;
            margin: 0 0.125rem;
        }

        .btn-edit {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .btn-edit:hover {
            background-color: #bfdbfe;
        }

        .btn-delete {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .btn-delete:hover {
            background-color: #fecaca;
        }

        .modal-content {
            border-radius: 0.75rem;
            border: none;
        }

        .modal-header {
            background-color: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            border-radius: 0.75rem 0.75rem 0 0;
        }

        .modal-title {
            font-weight: 700;
            color: #1e293b;
        }

        .form-label {
            font-weight: 600;
            color: #475569;
            margin-bottom: 0.5rem;
        }

        .form-control, .form-select {
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 0.625rem 0.75rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .user-avatar {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-box-open me-2"></i>
                Frenos y Embragues Neko
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Ventas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Inventario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Reportes</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <i class="fas fa-bell fs-5 text-secondary me-3"></i>
                    <img src="https://ui-avatars.com/api/?name=Usuario&background=2563eb&color=fff" 
                         alt="Usuario" class="user-avatar">
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <div class="container main-container">
        <!-- Header -->
        <div class="page-header">
            <h1 class="page-title">Gestión de Productos</h1>
            <button class="btn btn-primary" onclick="abrirModalCrear()">
                <i class="fas fa-plus me-2"></i>
                Nuevo Producto
            </button>
        </div>

        <!-- Sección de Búsqueda y Filtros -->
        <div class="search-section">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="position-relative">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" id="searchInput" class="form-control search-input" 
                               placeholder="Buscar por código o nombre" style="padding-left: 2.5rem;">
                    </div>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-outline-primary" onclick="buscarProductos()">
                        <i class="fas fa-search me-2"></i>Buscar
                    </button>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <div class="filter-tabs" id="filterTabs">
                        <button class="filter-tab active" onclick="filtrarCategoria('')">Todas</button>
                        <?php foreach($categorias as $cat): ?>
                        <button class="filter-tab" onclick="filtrarCategoria(<?= $cat['id_categoria'] ?>)">
                            <?= htmlspecialchars($cat['nombre']) ?>
                        </button>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de Productos -->
        <div class="table-container">
            <table class="table" id="tablaProductos">
                <thead>
                    <tr>
                        <th>CÓDIGO</th>
                        <th>NOMBRE</th>
                        <th>DESCRIPCIÓN</th>
                        <th>CATEGORÍA</th>
                        <th>MARCA</th>
                        <th>UNIDAD</th>
                        <th>P. COMPRA</th>
                        <th>P. VENTA</th>
                        <th>STOCK MÍN.</th>
                        <th>ESTADO</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                </thead>
                <tbody id="productosBody">
                    <?php if(count($productos) > 0): ?>
                        <?php foreach($productos as $producto): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($producto['codigo']) ?></strong></td>
                            <td><?= htmlspecialchars($producto['nombre']) ?></td>
                            <td><span class="text-muted"><?= htmlspecialchars(substr($producto['descripcion'] ?? '', 0, 50)) ?><?= strlen($producto['descripcion'] ?? '') > 50 ? '...' : '' ?></span></td>
                            <td><?= htmlspecialchars($producto['categoria_nombre'] ?? 'Sin categoría') ?></td>
                            <td><?= htmlspecialchars($producto['marca_nombre'] ?? 'Sin marca') ?></td>
                            <td><?= htmlspecialchars($producto['unidad_medida'] ?? 'N/A') ?></td>
                            <td><strong>S/ <?= number_format($producto['precio_compra'], 2) ?></strong></td>
                            <td><strong>S/ <?= number_format($producto['precio_venta'], 2) ?></strong></td>
                            <td><?= $producto['stock_minimo'] ?></td>
                            <td>
                                <?php if($producto['estado'] == 1): ?>
                                    <span class="badge badge-success">
                                        <i class="fas fa-circle me-1" style="font-size: 0.5rem;"></i>
                                        Disponible
                                    </span>
                                <?php else: ?>
                                    <span class="badge badge-danger">
                                        <i class="fas fa-circle me-1" style="font-size: 0.5rem;"></i>
                                        Inactivo
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <button class="btn-action btn-edit" 
                                        onclick="editarProducto(<?= $producto['id_producto'] ?>)"
                                        title="Editar">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button class="btn-action btn-delete" 
                                        onclick="eliminarProducto(<?= $producto['id_producto'] ?>, '<?= htmlspecialchars($producto['nombre'], ENT_QUOTES) ?>')"
                                        title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="11" class="text-center py-5">
                                <i class="fas fa-box-open fs-1 text-muted mb-3 d-block"></i>
                                <p class="text-muted">No hay productos registrados</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Crear/Editar Producto -->
    <div class="modal fade" id="modalProducto" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Registrar Nuevo Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="formProducto">
                        <input type="hidden" id="id_producto" name="id_producto">
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="codigo" class="form-label">Código*</label>
                                <input type="text" class="form-control" id="codigo" name="codigo" 
                                       placeholder="Código único del producto" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre del Producto*</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" 
                                       placeholder="Ingrese el nombre del producto" required>
                            </div>
                            
                            <div class="col-md-4">
                                <label for="id_categoria" class="form-label">Categoría*</label>
                                <select class="form-select" id="id_categoria" name="id_categoria" required>
                                    <option value="">Seleccione una categoría</option>
                                    <?php foreach($categorias as $cat): ?>
                                        <option value="<?= $cat['id_categoria'] ?>">
                                            <?= htmlspecialchars($cat['nombre']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="col-md-4">
                                <label for="id_marca" class="form-label">Marca*</label>
                                <select class="form-select" id="id_marca" name="id_marca" required>
                                    <option value="">Seleccione una marca</option>
                                    <?php foreach($marcas as $marca): ?>
                                        <option value="<?= $marca['id_marca'] ?>">
                                            <?= htmlspecialchars($marca['nombre']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="col-md-4">
                                <label for="id_medida" class="form-label">Unidad de Medida*</label>
                                <select class="form-select" id="id_medida" name="id_medida" required>
                                    <option value="">Seleccione unidad</option>
                                    <?php foreach($unidades as $unidad): ?>
                                        <option value="<?= $unidad['id_medida'] ?>">
                                            <?= htmlspecialchars($unidad['descripcion']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="col-12">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" 
                                          rows="2" placeholder="Descripción del producto"></textarea>
                            </div>
                            
                            <div class="col-md-4">
                                <label for="precio_compra" class="form-label">Precio Compra*</label>
                                <input type="number" class="form-control" id="precio_compra" 
                                       name="precio_compra" step="0.01" min="0" value="0.00" required>
                            </div>
                            
                            <div class="col-md-4">
                                <label for="precio_venta" class="form-label">Precio Venta*</label>
                                <input type="number" class="form-control" id="precio_venta" 
                                       name="precio_venta" step="0.01" min="0" value="0.00" required>
                            </div>
                            
                            <div class="col-md-4">
                                <label for="stock_minimo" class="form-label">Stock Mínimo*</label>
                                <input type="number" class="form-control" id="stock_minimo" 
                                       name="stock_minimo" step="0.01" min="0" value="0.00" required>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="estado" 
                                           name="estado" checked>
                                    <label class="form-check-label" for="estado">
                                        Activo
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="button" class="btn btn-primary" onclick="guardarProducto()">
                        <i class="fas fa-save me-2"></i>Guardar Producto
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        let modalProducto;
        let modoEdicion = false;

        document.addEventListener('DOMContentLoaded', function() {
            modalProducto = new bootstrap.Modal(document.getElementById('modalProducto'));
            
            // Búsqueda al presionar Enter
            document.getElementById('searchInput').addEventListener('keypress', function(e) {
                if(e.key === 'Enter') {
                    buscarProductos();
                }
            });
        });

        function abrirModalCrear() {
            modoEdicion = false;
            document.getElementById('modalTitle').textContent = 'Registrar Nuevo Producto';
            document.getElementById('formProducto').reset();
            document.getElementById('id_producto').value = '';
            document.getElementById('estado').checked = true;
            modalProducto.show();
        }

        function editarProducto(id) {
            modoEdicion = true;
            document.getElementById('modalTitle').textContent = 'Editar Producto';
            
            // Cargar datos del producto
            fetch(`ajax/productos.php?action=obtener&id=${id}`)
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        const producto = data.producto;
                        document.getElementById('id_producto').value = producto.id_producto;
                        document.getElementById('codigo').value = producto.codigo;
                        document.getElementById('nombre').value = producto.nombre;
                        document.getElementById('descripcion').value = producto.descripcion || '';
                        document.getElementById('id_categoria').value = producto.id_categoria;
                        document.getElementById('id_marca').value = producto.id_marca;
                        document.getElementById('id_medida').value = producto.id_medida;
                        document.getElementById('precio_compra').value = producto.precio_compra;
                        document.getElementById('precio_venta').value = producto.precio_venta;
                        document.getElementById('stock_minimo').value = producto.stock_minimo;
                        document.getElementById('estado').checked = producto.estado == 1;
                        modalProducto.show();
                    } else {
                        Swal.fire('Error', data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error', 'No se pudo cargar el producto', 'error');
                });
        }

        function guardarProducto() {
            const form = document.getElementById('formProducto');
            
            if(!form.checkValidity()) {
                form.reportValidity();
                return;
            }
            
            const formData = new FormData(form);
            const action = modoEdicion ? 'actualizar' : 'guardar';
            
            fetch(`ajax/productos.php?action=${action}`, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: data.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                    modalProducto.hide();
                } else {
                    Swal.fire('Error', data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error', 'Ocurrió un error al guardar el producto', 'error');
            });
        }

        function eliminarProducto(id, nombre) {
            Swal.fire({
                title: '¿Está seguro?',
                html: `Se eliminará el producto:<br><strong>${nombre}</strong>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData();
                    formData.append('id_producto', id);
                    
                    fetch('ajax/productos.php?action=eliminar', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if(data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Eliminado',
                                text: data.message,
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error', data.message, 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error', 'Ocurrió un error al eliminar el producto', 'error');
                    });
                }
            });
        }

        function buscarProductos() {
            const termino = document.getElementById('searchInput').value;
            
            fetch(`ajax/productos.php?action=buscar&termino=${encodeURIComponent(termino)}`)
                .then(response => response.json())
                .then(data => {
                    actualizarTabla(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error', 'Ocurrió un error en la búsqueda', 'error');
                });
        }

        function filtrarCategoria(idCategoria) {
            // Actualizar tabs activos
            document.querySelectorAll('.filter-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            event.target.classList.add('active');
            
            const url = idCategoria 
                ? `ajax/productos.php?action=filtrar&categoria=${idCategoria}`
                : `ajax/productos.php?action=listar`;
            
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    actualizarTabla(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error', 'Ocurrió un error al filtrar', 'error');
                });
        }

        function actualizarTabla(productos) {
            const tbody = document.getElementById('productosBody');
            
            if(productos.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="11" class="text-center py-5">
                            <i class="fas fa-box-open fs-1 text-muted mb-3 d-block"></i>
                            <p class="text-muted">No se encontraron productos</p>
                        </td>
                    </tr>
                `;
                return;
            }
            
            tbody.innerHTML = productos.map(producto => `
                <tr>
                    <td><strong>${producto.codigo}</strong></td>
                    <td>${producto.nombre}</td>
                    <td><span class="text-muted">${(producto.descripcion || '').substring(0, 50)}${(producto.descripcion || '').length > 50 ? '...' : ''}</span></td>
                    <td>${producto.categoria_nombre || 'Sin categoría'}</td>
                    <td>${producto.marca_nombre || 'Sin marca'}</td>
                    <td>${producto.unidad_medida || 'N/A'}</td>
                    <td><strong>S/ ${parseFloat(producto.precio_compra).toFixed(2)}</strong></td>
                    <td><strong>S/ ${parseFloat(producto.precio_venta).toFixed(2)}</strong></td>
                    <td>${producto.stock_minimo}</td>
                    <td>
                        ${producto.estado == 1 
                            ? '<span class="badge badge-success"><i class="fas fa-circle me-1" style="font-size: 0.5rem;"></i>Disponible</span>'
                            : '<span class="badge badge-danger"><i class="fas fa-circle me-1" style="font-size: 0.5rem;"></i>Inactivo</span>'
                        }
                    </td>
                    <td class="text-center">
                        <button class="btn-action btn-edit" onclick="editarProducto(${producto.id_producto})" title="Editar">
                            <i class="fas fa-pen"></i>
                        </button>
                        <button class="btn-action btn-delete" onclick="eliminarProducto(${producto.id_producto}, '${producto.nombre.replace(/'/g, "\\'")}');" title="Eliminar">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `).join('');
        }
    </script>
</body>
</html>