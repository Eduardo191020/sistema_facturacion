<?php
header('Content-Type: application/json');
require_once '../config/Database.php';
require_once '../models/Producto.php';
require_once '../models/Categoria.php';
require_once '../models/Marca.php';
require_once '../models/UnidadMedida.php';

$database = new Database();
$db = $database->getConnection();
$producto = new Producto($db);

$action = $_GET['action'] ?? '';

switch($action) {
    case 'listar':
        $stmt = $producto->obtenerTodos();
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($productos);
        break;
        
    case 'obtener':
        $producto->id_producto = $_GET['id'];
        if($producto->obtenerPorId()) {
            echo json_encode([
                'success' => true,
                'producto' => [
                    'id_producto' => $producto->id_producto,
                    'codigo' => $producto->codigo,
                    'nombre' => $producto->nombre,
                    'descripcion' => $producto->descripcion,
                    'id_categoria' => $producto->id_categoria,
                    'id_marca' => $producto->id_marca,
                    'id_medida' => $producto->id_medida,
                    'precio_compra' => $producto->precio_compra,
                    'precio_venta' => $producto->precio_venta,
                    'stock_minimo' => $producto->stock_minimo,
                    'estado' => $producto->estado
                ]
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Producto no encontrado']);
        }
        break;
        
    case 'obtener_datos_modal':
        $categoria = new Categoria($db);
        $categorias = $categoria->obtenerActivas()->fetchAll(PDO::FETCH_ASSOC);
        
        $marca = new Marca($db);
        $marcas = $marca->obtenerActivas()->fetchAll(PDO::FETCH_ASSOC);
        
        $unidad = new UnidadMedida($db);
        $unidades = $unidad->obtenerTodas()->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode([
            'success' => true,
            'categorias' => $categorias,
            'marcas' => $marcas,
            'unidades' => $unidades
        ]);
        break;
        
    case 'guardar':
        $producto->codigo = $_POST['codigo'];
        $producto->nombre = $_POST['nombre'];
        $producto->descripcion = $_POST['descripcion'] ?? '';
        $producto->id_categoria = $_POST['id_categoria'];
        $producto->id_marca = $_POST['id_marca'];
        $producto->id_medida = $_POST['id_medida'];
        $producto->precio_compra = $_POST['precio_compra'];
        $producto->precio_venta = $_POST['precio_venta'];
        $producto->stock_minimo = $_POST['stock_minimo'];
        $producto->estado = isset($_POST['estado']) ? 1 : 0;
        
        if($producto->codigoExiste()) {
            echo json_encode(['success' => false, 'message' => 'El código ya existe']);
            exit;
        }
        
        if($producto->crear()) {
            echo json_encode(['success' => true, 'message' => 'Producto creado exitosamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al crear el producto']);
        }
        break;
        
    case 'actualizar':
        $producto->id_producto = $_POST['id_producto'];
        $producto->codigo = $_POST['codigo'];
        $producto->nombre = $_POST['nombre'];
        $producto->descripcion = $_POST['descripcion'] ?? '';
        $producto->id_categoria = $_POST['id_categoria'];
        $producto->id_marca = $_POST['id_marca'];
        $producto->id_medida = $_POST['id_medida'];
        $producto->precio_compra = $_POST['precio_compra'];
        $producto->precio_venta = $_POST['precio_venta'];
        $producto->stock_minimo = $_POST['stock_minimo'];
        $producto->estado = isset($_POST['estado']) ? 1 : 0;
        
        if($producto->codigoExiste()) {
            echo json_encode(['success' => false, 'message' => 'El código ya existe']);
            exit;
        }
        
        if($producto->actualizar()) {
            echo json_encode(['success' => true, 'message' => 'Producto actualizado exitosamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar el producto']);
        }
        break;
        
    case 'eliminar':
        $producto->id_producto = $_POST['id_producto'];
        
        if($producto->eliminar()) {
            echo json_encode(['success' => true, 'message' => 'Producto eliminado exitosamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al eliminar el producto. Puede que tenga movimientos asociados.']);
        }
        break;
        
    case 'buscar':
        $termino = $_GET['termino'] ?? '';
        $stmt = $producto->buscar($termino);
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($productos);
        break;
        
    case 'filtrar':
        $id_categoria = $_GET['categoria'] ?? '';
        if($id_categoria) {
            $stmt = $producto->filtrarPorCategoria($id_categoria);
        } else {
            $stmt = $producto->obtenerTodos();
        }
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($productos);
        break;
        
    default:
        echo json_encode(['success' => false, 'message' => 'Acción no válida']);
        break;
}
?>