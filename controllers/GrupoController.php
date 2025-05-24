<?php
// controllers/GrupoController.php
class GrupoController {
    private $grupo;
    private $tutor;
    private $estudiante;
    
    public function __construct($db) {
        $this->grupo = new Grupo($db);
        $this->tutor = new Tutor($db);
        $this->estudiante = new Estudiante($db);
    }
    
    public function index() {
        $grupos = $this->grupo->obtenerTodos();
        include 'views/grupos/index.php';
    }
    
    public function crear() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $codigo_tutor = $_POST['codigo_tutor'];
            
            if($this->grupo->crear($nombre, $codigo_tutor)) {
                header("Location: grupos.php");
                exit();
            }
        }
        
        $tutores = $this->tutor->obtenerTodos();
        include 'views/grupos/crear.php';
    }
    
    public function asignar($grupo_id) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $estudiantes = $_POST['estudiantes'] ?? [];
            foreach($estudiantes as $codigo_estudiante) {
                $this->grupo->asignarEstudiante($grupo_id, $codigo_estudiante);
            }
            header("Location: grupos.php");
            exit();
        }
        
        $estudiantes = $this->estudiante->obtenerTodos();
        include 'views/grupos/asignar.php';
    }
    
    public function eliminar($id) {
        $this->grupo->eliminar($id);
        header("Location: grupos.php");
        exit();
    }
}
?>