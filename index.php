<?php
// index.php
session_start();
if(isset($_SESSION['user_id'])) {
    if($_SESSION['tipo'] == 'admin') {
        header("Location: dashboard.php");
    } else {
        header("Location: asistencia.php");
    }
    exit();
}

require_once 'config/database.php';
require_once 'models/Usuario.php';
require_once 'controllers/AuthController.php';

$database = new Database();
$db = $database->getConnection();
$auth = new AuthController($db);
$auth->login();
?>