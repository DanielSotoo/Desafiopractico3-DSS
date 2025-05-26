<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['tipo'] != 'admin') {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }
        .page-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .main-content {
            flex: 1;
        }
        .navbar {
            height: 80px;
        }
        .navbar-brand {
            font-size: 1.6rem;
            font-weight: bold;
        }
        .section-title-bar {
            background-color: #0d6efd;
            color: white;
            padding: 2rem 1rem;
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
            width: 100%;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
            transition: transform 0.2s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .footer {
            background-color: #212529;
            color: white;
            padding: 2rem 0;
            text-align: center;
        }
        .footer .row > div {
            font-size: 1.1rem;
            font-weight: 500;
        }
    </style>
</head>
<body>
<div class="page-container">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Academia</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link text-white" href="logout.php">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <div class="section-title-bar"> PANEL DE ADMINISTRACIÓN </div>
    
    <div class="main-content container py-5">
        <div class="row justify-content-center g-4">
            <div class="col-md-5">
                <div class="card text-center p-4">
                    <h5 class="card-title">Gestión de Grupos</h5>
                    <p class="card-text">Crear y administrar grupos de estudiantes</p>
                    <a href="grupos.php" class="btn btn-primary">Ir a Grupos</a>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card text-center p-4">
                    <h5 class="card-title">Reportes</h5>
                    <p class="card-text">Generar reportes trimestrales</p>
                    <a href="reportes.php" class="btn btn-success">Ver Reportes</a>
                </div>
            </div>
        </div>
    </div>
    
    <footer class="footer mt-auto">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">Oscar Daniel Soto Jovel</div>
                <div class="col-md-4">Salvador Enrique Delgado Peñate</div>
            </div>
        </div>
    </footer>

</div>
</body>
</html>
