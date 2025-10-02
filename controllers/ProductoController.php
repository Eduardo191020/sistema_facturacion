<?php
require_once 'config/Database.php';
require_once 'models/Producto.php';
require_once 'models/Categoria.php';
require_once 'models/Marca.php';
require_once 'models/UnidadMedida.php';

class ProductoController {
    private $db;
    private $producto;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->producto = new Producto($this->db);
    }
    
    // Listar productos
    public function index() {
        $stmt = $this->producto->obtenerTodos();
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $categoria = new Categoria($this->db);
        $categorias = $categoria->obtenerActivas()->fetchAll(PDO::FETCH_ASSOC);
        
        $marca = new Marca($this->db);
        $marcas = $marca->obtenerActivas()->fetchAll(PDO::FETCH_ASSOC);
        
        $unidad = new UnidadMedida($this->db);
        $unidades = $unidad->obtenerTodas()->fetchAll(PDO::FETCH_ASSOC);
        
        require_once 'views/productos/index.php';
    }
    
    // Obtener datos para el modal
    public function obtenerDatosModal() {
        $categoria = new Categoria($this->db);
        $categorias = $categoria->obtenerActivas()->fetchAll(PDO::FETCH_ASSOC);
        
        $marca = new Marca($this->db);
        $marcas = $marca->obtenerActivas()->fetchAll(PDO::FETCH_ASSOC);
        
        $unidad = new UnidadMedida($this->db);
        $unidades = $unidad->obtenerTodas()->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode([
            'success' => true,
            'categorias' => $categorias,
            'marcas' => $marcas,
            'unidades' => $unidades
        ]);
    }
}
?>