<?php
// controllers/AsistenciaController.php
class AsistenciaController {
    private $grupo;
    private $estudiante;
    private $asistencia;
    private $aspecto;
    
    public function __construct($db) {
        $this->grupo = new Grupo($db);
        $this->estudiante = new Estudiante($db);
        $this->asistencia = new Asistencia($db);
        $this->aspecto = new Aspecto($db);
        
        // Configurar zona horaria
        date_default_timezone_set('America/Lima');
    }
    
    public function index() {
        // Modo desarrollo (true para desactivar verificación de horario)
        $modo_desarrollo = true;
        
        if (!$modo_desarrollo) {
            $this->verificarHorarioPermitido();
        }
        
        // Verificar sesión (ya iniciada en asistencia.php)
        if (!isset($_SESSION['codigo_tutor'])) {
            $this->mostrarError("Debe iniciar sesión como tutor");
            return;
        }
        
        $codigo_tutor = $_SESSION['codigo_tutor'];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->procesarFormulario($codigo_tutor);
            $mensaje = "Asistencia y aspectos registrados correctamente";
        }
        
        $this->mostrarVistaAsistencia($codigo_tutor);
    }
    
    private function verificarHorarioPermitido() {
        $dia_semana = date('w'); // 0 = domingo, 6 = sábado
        $hora = date('H');
        
        if ($dia_semana != 6 || $hora < 8 || $hora >= 11) {
            $this->mostrarError("Solo puede tomar asistencia los sábados de 8:00am a 11:00am");
            return;
        }
    }
    
    private function procesarFormulario($codigo_tutor) {
        // Procesar asistencias
        $asistencias = $_POST['asistencia'] ?? [];
        foreach ($asistencias as $codigo_estudiante => $tipo) {
            $this->asistencia->marcar($codigo_estudiante, $codigo_tutor, $tipo);
        }
        
        // Procesar aspectos
        $aspectos = $_POST['aspectos'] ?? [];
        foreach ($aspectos as $codigo_estudiante => $aspectos_estudiante) {
            foreach ($aspectos_estudiante as $codigo_aspecto) {
                if (!empty($codigo_aspecto)) {
                    $this->aspecto->asignar($codigo_aspecto, $codigo_estudiante, $codigo_tutor);
                }
            }
        }
    }
    
    private function mostrarVistaAsistencia($codigo_tutor) {
        $grupo = $this->grupo->obtenerPorTutor($codigo_tutor);
        if (!$grupo) {
            $this->mostrarError("No se encontró el grupo asignado al tutor");
            return;
        }
        
        $estudiantes = $this->estudiante->obtenerPorGrupo($grupo['id']);
        $aspectos = $this->aspecto->obtenerTodos();
        
        include 'views/asistencia/index.php';
    }
    
    private function mostrarError($mensaje) {
        $error = $mensaje;
        include 'views/error.php';
    }
}
?>