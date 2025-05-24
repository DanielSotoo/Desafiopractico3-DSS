<?php
class Estudiante {
    private $conn;
    private $table = 'estudiantes';
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function obtenerTodos() {
        $query = "SELECT * FROM " . $this->table . " WHERE estado = 'activo'";
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
    
    public function obtenerPorGrupo($grupo_id) {
        $query = "SELECT e.* FROM " . $this->table . " e 
                  INNER JOIN grupo_estudiantes ge ON e.codigo = ge.codigo_estudiante 
                  WHERE ge.grupo_id = ? AND e.estado = 'activo'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$grupo_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>