<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// grupos.php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['tipo'] != 'admin') {
    header("Location: index.php");
    exit();
}

require_once 'config/database.php';
require_once 'models/Grupo.php';
require_once 'models/Tutor.php';
require_once 'models/Estudiante.php';
require_once 'controllers/GrupoController.php';

$database = new Database();
$db = $database->getConnection();
$controller = new GrupoController($db);

$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

switch($action) {
    case 'crear':
        $controller->crear();
        break;
    case 'asignar':
        $controller->asignar($id);
        break;
    case 'eliminar':
        $controller->eliminar($id);
        break;
    default:
        $controller->index();
}
?>