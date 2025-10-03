<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos - Frenos y Embragues Neko</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/sistema_facturacion/assets/css/productos.css">
    <script src="/sistema_facturacion/assets/js/productos.js"></script>
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
                                       name="precio_compra" step="1" min="1" value="" required>
                            </div>
                            
                            <div class="col-md-4">
                                <label for="precio_venta" class="form-label">Precio Venta*</label>
                                <input type="number" class="form-control" id="precio_venta" 
                                       name="precio_venta" step="1" min="1" value="" required>
                            </div>
                            
                            <div class="col-md-4">
                                <label for="stock_minimo" class="form-label">Stock Mínimo*</label>
                                <input type="number" class="form-control" id="stock_minimo" 
                                       name="stock_minimo" step="1" min="1" value="" required>
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
</body>
</html>
