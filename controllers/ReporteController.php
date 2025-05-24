<?php
// Incluir los modelos necesarios
require_once dirname(__DIR__) . '/models/Estudiante.php';
require_once dirname(__DIR__) . '/models/Asistencia.php';
require_once dirname(__DIR__) . '/models/Aspecto.php';
require_once dirname(__DIR__) . '/models/Tutor.php';
require_once dirname(__DIR__) . '/models/Grupo.php';

class ReporteController {
    private $estudiante;
    private $asistencia;
    private $aspecto;
    private $tutor;
    private $grupo;
    
    public function __construct($db) {
        $this->estudiante = new Estudiante($db);
        $this->asistencia = new Asistencia($db);
        $this->aspecto = new Aspecto($db);
        $this->tutor = new Tutor($db);
        $this->grupo = new Grupo($db);
    }
    
    public function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $codigo_estudiante = $_POST['codigo_estudiante'];
            $trimestre = $_POST['trimestre'];
            
            header("Location: reporte_pdf.php?estudiante=$codigo_estudiante&trimestre=$trimestre");
            exit();
        }

        $estudiantes = $this->estudiante->obtenerTodos();
        include 'views/reportes/index.php';
    }
    
    public function generarPDF($codigo_estudiante, $trimestre) {
        $estudiante = $this->estudiante->obtenerPorCodigo($codigo_estudiante);
        $asistencias = $this->asistencia->obtenerPorEstudianteTrimestre($codigo_estudiante, $trimestre);
        $aspectos = $this->aspecto->obtenerPorEstudianteTrimestre($codigo_estudiante, $trimestre);
        
        // Calcular semáforo
        $semaforo = $this->calcularSemaforo($asistencias, $aspectos);
        
        // Obtener tutor y grupo del estudiante
        $tutor_info = null;
        $grupo_info = null;
        foreach ($this->grupo->obtenerTodos() as $grupo) {
            $estudiantes_grupo = $this->estudiante->obtenerPorGrupo($grupo['id']);
            foreach ($estudiantes_grupo as $est) {
                if ($est['codigo'] == $codigo_estudiante) {
                    $tutor_info = $this->tutor->obtenerPorCodigo($grupo['codigo_tutor']);
                    $grupo_info = $grupo;
                    break 2;
                }
            }
        }
        
        include 'views/reportes/pdf.php';
    }
    
    private function calcularSemaforo($asistencias, $aspectos) {
        $positivos = 0;
        $leves = 0;
        $graves = 0;
        $muy_graves = 0;
        $inasistencias = 0;
        
        foreach ($aspectos as $aspecto) {
            switch ($aspecto['tipo']) {
                case 'P': $positivos++; break;
                case 'L': $leves++; break;
                case 'G': $graves++; break;
                case 'MG': $muy_graves++; break;
            }
        }
        
        foreach ($asistencias as $asistencia) {
            if ($asistencia['tipo'] == 'I') {
                $inasistencias++;
            }
        }
        
        // Lógica del semáforo
        if ($muy_graves >= 1 || $graves >= 2 || ($leves >= 12 || $inasistencias >= 8) || 
            ($leves >= 6 && $inasistencias >= 4 && $graves >= 1)) {
            return 'rojo';
        } elseif ($graves >= 1 || $leves >= 6 || $inasistencias >= 4) {
            return 'amarillo';
        } elseif ($positivos >= 4 && ($leves <= 1 && $inasistencias <= 1)) {
            return 'azul';
        } elseif ($leves <= 2 && $inasistencias <= 2) {
            return 'verde';
        } else {
            return 'amarillo';
        }
    }
}
