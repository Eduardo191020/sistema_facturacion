<?php
class Categoria {
    private $conn;
    private $table = "categoria";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function obtenerActivas() {
        $query = "SELECT * FROM {$this->table} WHERE estado = 1 ORDER BY nombre";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>