<?php
class Producto {
    private $conn;
    private $table = "producto";

    public $id_producto;
    public $id_categoria;
    public $id_marca;
    public $id_medida;
    public $codigo;
    public $nombre;
    public $descripcion;
    public $precio_compra;
    public $precio_venta;
    public $stock_minimo;
    public $estado;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener todos los productos (SIN stock_actual calculado)
    public function obtenerTodos() {
        $query = "SELECT 
                    p.id_producto,
                    p.codigo,
                    p.nombre,
                    p.descripcion,
                    p.precio_compra,
                    p.precio_venta,
                    p.stock_minimo,
                    p.estado,
                    p.id_categoria,
                    p.id_marca,
                    p.id_medida,
                    c.nombre as categoria_nombre,
                    m.nombre as marca_nombre,
                    um.descripcion as unidad_medida
                  FROM {$this->table} p
                  LEFT JOIN categoria c ON p.id_categoria = c.id_categoria
                  LEFT JOIN marca m ON p.id_marca = m.id_marca
                  LEFT JOIN unidad_medida um ON p.id_medida = um.id_medida
                  ORDER BY p.id_producto DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Buscar productos por código o nombre
    public function buscar($termino) {
        $query = "SELECT 
                    p.id_producto,
                    p.codigo,
                    p.nombre,
                    p.descripcion,
                    p.precio_compra,
                    p.precio_venta,
                    p.stock_minimo,
                    p.estado,
                    p.id_categoria,
                    p.id_marca,
                    p.id_medida,
                    c.nombre as categoria_nombre,
                    m.nombre as marca_nombre,
                    um.descripcion as unidad_medida
                  FROM {$this->table} p
                  LEFT JOIN categoria c ON p.id_categoria = c.id_categoria
                  LEFT JOIN marca m ON p.id_marca = m.id_marca
                  LEFT JOIN unidad_medida um ON p.id_medida = um.id_medida
                  WHERE p.codigo LIKE :termino OR p.nombre LIKE :termino
                  ORDER BY p.id_producto DESC";
        
        $stmt = $this->conn->prepare($query);
        $termino = "%{$termino}%";
        $stmt->bindParam(":termino", $termino);
        $stmt->execute();
        return $stmt;
    }

    // Filtrar por categoría
    public function filtrarPorCategoria($id_categoria) {
        $query = "SELECT 
                    p.id_producto,
                    p.codigo,
                    p.nombre,
                    p.descripcion,
                    p.precio_compra,
                    p.precio_venta,
                    p.stock_minimo,
                    p.estado,
                    p.id_categoria,
                    p.id_marca,
                    p.id_medida,
                    c.nombre as categoria_nombre,
                    m.nombre as marca_nombre,
                    um.descripcion as unidad_medida
                  FROM {$this->table} p
                  LEFT JOIN categoria c ON p.id_categoria = c.id_categoria
                  LEFT JOIN marca m ON p.id_marca = m.id_marca
                  LEFT JOIN unidad_medida um ON p.id_medida = um.id_medida
                  WHERE p.id_categoria = :id_categoria
                  ORDER BY p.id_producto DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_categoria", $id_categoria);
        $stmt->execute();
        return $stmt;
    }

    // Crear producto
    public function crear() {
        $query = "INSERT INTO {$this->table} 
                  (id_categoria, id_marca, id_medida, codigo, nombre, descripcion, 
                   precio_compra, precio_venta, stock_minimo, estado)
                  VALUES 
                  (:id_categoria, :id_marca, :id_medida, :codigo, :nombre, :descripcion,
                   :precio_compra, :precio_venta, :stock_minimo, :estado)";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":id_categoria", $this->id_categoria);
        $stmt->bindParam(":id_marca", $this->id_marca);
        $stmt->bindParam(":id_medida", $this->id_medida);
        $stmt->bindParam(":codigo", $this->codigo);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":precio_compra", $this->precio_compra);
        $stmt->bindParam(":precio_venta", $this->precio_venta);
        $stmt->bindParam(":stock_minimo", $this->stock_minimo);
        $stmt->bindParam(":estado", $this->estado);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Obtener un producto por ID
    public function obtenerPorId() {
        $query = "SELECT * FROM {$this->table} WHERE id_producto = :id_producto LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_producto", $this->id_producto);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row) {
            $this->codigo = $row['codigo'];
            $this->nombre = $row['nombre'];
            $this->descripcion = $row['descripcion'];
            $this->id_categoria = $row['id_categoria'];
            $this->id_marca = $row['id_marca'];
            $this->id_medida = $row['id_medida'];
            $this->precio_compra = $row['precio_compra'];
            $this->precio_venta = $row['precio_venta'];
            $this->stock_minimo = $row['stock_minimo'];
            $this->estado = $row['estado'];
            return true;
        }
        return false;
    }

    // Actualizar producto
    public function actualizar() {
        $query = "UPDATE {$this->table} 
                  SET 
                    id_categoria = :id_categoria,
                    id_marca = :id_marca,
                    id_medida = :id_medida,
                    codigo = :codigo,
                    nombre = :nombre,
                    descripcion = :descripcion,
                    precio_compra = :precio_compra,
                    precio_venta = :precio_venta,
                    stock_minimo = :stock_minimo,
                    estado = :estado
                  WHERE id_producto = :id_producto";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":id_categoria", $this->id_categoria);
        $stmt->bindParam(":id_marca", $this->id_marca);
        $stmt->bindParam(":id_medida", $this->id_medida);
        $stmt->bindParam(":codigo", $this->codigo);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":precio_compra", $this->precio_compra);
        $stmt->bindParam(":precio_venta", $this->precio_venta);
        $stmt->bindParam(":stock_minimo", $this->stock_minimo);
        $stmt->bindParam(":estado", $this->estado);
        $stmt->bindParam(":id_producto", $this->id_producto);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Eliminar producto
    public function eliminar() {
        $query = "DELETE FROM {$this->table} WHERE id_producto = :id_producto";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_producto", $this->id_producto);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Verificar si el código ya existe
    public function codigoExiste() {
        $query = "SELECT id_producto FROM {$this->table} 
                  WHERE codigo = :codigo AND id_producto != :id_producto LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":codigo", $this->codigo);
        $id = isset($this->id_producto) ? $this->id_producto : 0;
        $stmt->bindParam(":id_producto", $id);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }
}
?>