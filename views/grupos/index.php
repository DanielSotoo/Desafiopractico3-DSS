<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Grupos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            background-color: #f5f7fa;
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
            background-color: #0d6efd;
            height: 80px;
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .section-title-bar {
            background-color: rgb(12, 156, 84);
            color: white;
            padding: 2rem 1rem;
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
            width: 100%;
        }
        .grupos-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 2rem auto;
            max-width: 1200px;
        }
        .btn-success {
            background-color: #dc3545;
            border: none;
            font-weight: bold;
        }
        .btn-success:hover {
            background-color: #bb2d3b;
        }
        .table-container {
            max-width: 1200px;
            margin: auto;
        }
        .table th {
            background-color: #f0f0f0;
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

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">ACADEMIA</a>
            <div class="d-flex">
                <a class="nav-link text-white" href="dashboard.php">Dashboard</a>
                <a class="nav-link text-white" href="logout.php">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <div class="section-title-bar">
        GESTIÓN DE GRUPOS
    </div>

    <div class="main-content">
        <div class="grupos-header container">
            <h3 class="mb-0">Lista de Grupos</h3>
            <a href="grupos.php?action=crear" class="btn btn-success">+ Crear Grupo</a>
        </div>

        <div class="table-container table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Tutor</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($grupos as $grupo): ?>
                    <tr>
                        <td><?= $grupo['id'] ?></td>
                        <td><?= $grupo['nombre'] ?></td>
                        <td><?= $grupo['nombres'] . ' ' . $grupo['apellidos'] ?></td>
                        <td>
                            <a href="grupos.php?action=asignar&id=<?= $grupo['id'] ?>" class="btn btn-sm btn-warning">Asignar Estudiantes</a>
                            <a href="grupos.php?action=eliminar&id=<?= $grupo['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar grupo?')">Eliminar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer class="footer mt-auto">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">Oscar Daniel Soto Jovel</div>
                <div class="col-md-4">Salvador Enrique Delgado</div>
            </div>
        </div>
    </footer>

</div>
</body>
</html>
