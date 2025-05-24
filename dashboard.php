<?php
// dashboard.php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['tipo'] != 'admin') {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Panel de Administración</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Academia</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="logout.php">Cerrar Sesión</a>
            </div>
        </div>
    </nav>
    
    <div class="container mt-4">
        <h2>Panel de Administración</h2>
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Gestión de Grupos</h5>
                        <p class="card-text">Crear y administrar grupos de estudiantes</p>
                        <a href="grupos.php" class="btn btn-primary">Ir a Grupos</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Reportes</h5>
                        <p class="card-text">Generar reportes trimestrales</p>
                        <a href="reportes.php" class="btn btn-success">Ver Reportes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>