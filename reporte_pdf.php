<?php
// reporte_pdf.php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['tipo'] != 'admin') {
    header("Location: index.php");
    exit();
}

require_once 'config/database.php';
require_once 'models/Estudiante.php';
require_once 'models/Asistencia.php';
require_once 'models/Aspecto.php';
require_once 'models/Tutor.php';
require_once 'models/Grupo.php';
require_once 'controllers/ReporteController.php';

$database = new Database();
$db = $database->getConnection();
$controller = new ReporteController($db);

$codigo_estudiante = $_GET['estudiante'];
$trimestre = $_GET['trimestre'];

$controller->generarPDF($codigo_estudiante, $trimestre);
?>