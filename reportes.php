<?php
// reportes.php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['tipo'] != 'admin') {
    header("Location: index.php");
    exit();
}

require_once 'config/database.php';
require_once 'models/Estudiante.php';
require_once 'controllers/ReporteController.php';

$database = new Database();
$db = $database->getConnection();
$controller = new ReporteController($db);
$controller->index();
?>