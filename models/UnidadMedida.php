<?php
class UnidadMedida {
    private $conn;
    private $table = "unidad_medida";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function obtenerTodas() {
        $query = "SELECT * FROM {$this->table} ORDER BY descripcion";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>