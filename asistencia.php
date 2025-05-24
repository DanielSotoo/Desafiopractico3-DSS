<?php
// asistencia.php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['tipo'] != 'tutor') {
    header("Location: index.php");
    exit();
}

require_once 'config/database.php';
require_once 'models/Grupo.php';
require_once 'models/Estudiante.php';
require_once 'models/Asistencia.php';
require_once 'models/Aspecto.php';
require_once 'controllers/AsistenciaController.php';

$database = new Database();
$db = $database->getConnection();
$controller = new AsistenciaController($db);
$controller->index();
?>