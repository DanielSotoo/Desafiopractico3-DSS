<?php
class Tutor {
    private $conn;
    private $table = 'tutores';
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function obtenerTodos() {
        $query = "SELECT * FROM " . $this->table . " WHERE estado = 'contratado'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function obtenerPorCodigo($codigo) {
        $query = "SELECT * FROM " . $this->table . " WHERE codigo = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$codigo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>