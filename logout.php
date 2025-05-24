<?php
// logout.php
require_once 'controllers/AuthController.php';
$auth = new AuthController(null);
$auth->logout();
?>