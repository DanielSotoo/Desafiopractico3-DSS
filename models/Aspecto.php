<?php
// models/Aspecto.php
class Aspecto {
    private $conn;
    private $table = 'aspectos';
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function obtenerTodos() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY tipo, descripcion";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function asignar($codigo_aspecto, $codigo_estudiante, $codigo_tutor) {
        $query = "INSERT INTO asignacion_aspectos (codigo_aspecto, fecha, codigo_estudiante, codigo_tutor) 
                  VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$codigo_aspecto, date('Y-m-d'), $codigo_estudiante, $codigo_tutor]);
    }
    
    public function obtenerPorEstudianteTrimestre($codigo_estudiante, $trimestre, $ano = null) {
        if($ano === null) $ano = date('Y');
        
        // Usar el mismo método de cálculo de fechas que Asistencia
        $asistencia = new Asistencia($this->conn);
        $fechas = $this->calcularFechasTrimestre($trimestre, $ano);
        
        $query = "SELECT aa.*, a.descripcion, a.tipo FROM asignacion_aspectos aa 
                  INNER JOIN aspectos a ON aa.codigo_aspecto = a.id 
                  WHERE aa.codigo_estudiante = ? AND aa.fecha BETWEEN ? AND ?
                  ORDER BY aa.fecha";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$codigo_estudiante, $fechas['inicio'], $fechas['fin']]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    private function calcularFechasTrimestre($trimestre, $ano) {
        $fechas = [];
        switch($trimestre) {
            case 1:
                $fechas['inicio'] = "$ano-02-01";
                $fechas['fin'] = "$ano-04-30";
                break;
            case 2:
                $fechas['inicio'] = "$ano-05-01";
                $fechas['fin'] = "$ano-07-31";
                break;
            case 3:
                $fechas['inicio'] = "$ano-08-01";
                $fechas['fin'] = "$ano-10-31";
                break;
        }
        return $fechas;
    }
}
?>