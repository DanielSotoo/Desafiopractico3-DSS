<?php
// models/Asistencia.php
class Asistencia {
    private $conn;
    private $table = 'asistencias';
    
    // Tipos de asistencia como constantes (actualizados para coincidir con la vista)
    const ASISTENCIA_ASISTIO = 'A';
    const ASISTENCIA_INASISTENCIA = 'I';
    const ASISTENCIA_JUSTIFICADO = 'J';
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    /**
     * Marca la asistencia de un estudiante
     * 
     * @param string $codigo_estudiante
     * @param string $codigo_tutor
     * @param string $tipo (A=Asistió, I=Inasistencia, J=Justificado)
     * @return bool True si la operación fue exitosa
     */
    public function marcar($codigo_estudiante, $codigo_tutor, $tipo) {
        // Validar tipo de asistencia (valores actualizados)
        if (!in_array($tipo, [
            self::ASISTENCIA_ASISTIO, 
            self::ASISTENCIA_INASISTENCIA, 
            self::ASISTENCIA_JUSTIFICADO
        ])) {
            throw new InvalidArgumentException("Tipo de asistencia no válido. Valores permitidos: A, I, J");
        }
        
        $fecha = date('Y-m-d');
        
        try {
            $this->conn->beginTransaction();
            
            // Verificar si ya existe registro para hoy
            $existe = $this->verificarAsistenciaExistente($codigo_estudiante, $fecha);
            
            if ($existe) {
                $resultado = $this->actualizarAsistencia($codigo_estudiante, $codigo_tutor, $tipo, $fecha);
            } else {
                $resultado = $this->crearAsistencia($codigo_estudiante, $codigo_tutor, $tipo, $fecha);
            }
            
            $this->conn->commit();
            return $resultado;
            
        } catch (PDOException $e) {
            $this->conn->rollBack();
            error_log("Error en Asistencia::marcar(): " . $e->getMessage());
            return false;
        } catch (InvalidArgumentException $e) {
            $this->conn->rollBack();
            error_log("Error de validación: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Obtiene las asistencias de un estudiante por trimestre
     * 
     * @param string $codigo_estudiante
     * @param int $trimestre (1, 2 o 3)
     * @param int|null $ano
     * @return array Lista de asistencias
     */
    public function obtenerPorEstudianteTrimestre($codigo_estudiante, $trimestre, $ano = null) {
        $ano = $ano ?? date('Y');
        $fechas = $this->calcularFechasTrimestre($trimestre, $ano);
        
        try {
            $query = "SELECT fecha, tipo, fecha_actualizacion 
                     FROM {$this->table} 
                     WHERE codigo_estudiante = ? AND fecha BETWEEN ? AND ?
                     ORDER BY fecha ASC";
            
            $stmt = $this->conn->prepare($query);
            $stmt->execute([$codigo_estudiante, $fechas['inicio'], $fechas['fin']]);
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            error_log("Error en Asistencia::obtenerPorEstudianteTrimestre(): " . $e->getMessage());
            return [];
        }
    }
    
    /**
     * Verifica si ya existe un registro de asistencia para un estudiante en una fecha
     */
    private function verificarAsistenciaExistente($codigo_estudiante, $fecha) {
        $query = "SELECT 1 FROM {$this->table} 
                 WHERE fecha = ? AND codigo_estudiante = ? 
                 LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$fecha, $codigo_estudiante]);
        
        return $stmt->rowCount() > 0;
    }
    
    /**
     * Actualiza un registro de asistencia existente
     */
    private function actualizarAsistencia($codigo_estudiante, $codigo_tutor, $tipo, $fecha) {
        $query = "UPDATE {$this->table} 
                 SET tipo = :tipo, 
                     codigo_tutor = :tutor, 
                     fecha_actualizacion = NOW() 
                 WHERE fecha = :fecha AND codigo_estudiante = :estudiante";
        
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':tipo' => $tipo,
            ':tutor' => $codigo_tutor,
            ':fecha' => $fecha,
            ':estudiante' => $codigo_estudiante
        ]);
    }
    
    /**
     * Crea un nuevo registro de asistencia
     */
    private function crearAsistencia($codigo_estudiante, $codigo_tutor, $tipo, $fecha) {
        $query = "INSERT INTO {$this->table} 
                 (fecha, codigo_estudiante, codigo_tutor, tipo) 
                 VALUES (:fecha, :estudiante, :tutor, :tipo)";
        
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':fecha' => $fecha,
            ':estudiante' => $codigo_estudiante,
            ':tutor' => $codigo_tutor,
            ':tipo' => $tipo
        ]);
    }
    
    /**
     * Calcula las fechas de inicio y fin de un trimestre
     */
    private function calcularFechasTrimestre($trimestre, $ano) {
        $trimestres = [
            1 => ['inicio' => "$ano-02-01", 'fin' => "$ano-04-30"],
            2 => ['inicio' => "$ano-05-01", 'fin' => "$ano-07-31"],
            3 => ['inicio' => "$ano-08-01", 'fin' => "$ano-10-31"]
        ];
        
        return $trimestres[$trimestre] ?? ['inicio' => "$ano-01-01", 'fin' => "$ano-12-31"];
    }
    
    /**
     * Obtiene el texto descriptivo para un tipo de asistencia
     */
    public static function getDescripcionTipo($tipo) {
        switch ($tipo) {
            case self::ASISTENCIA_ASISTIO: return 'Asistió';
            case self::ASISTENCIA_INASISTENCIA: return 'Inasistencia';
            case self::ASISTENCIA_JUSTIFICADO: return 'Justificado';
            default: return 'Desconocido';
        }
    }
}