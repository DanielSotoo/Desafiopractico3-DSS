<?php
// views/grupos/index.php
?>
<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Grupos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">Academia</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="dashboard.php">Dashboard</a>
                <a class="nav-link" href="logout.php">Cerrar Sesión</a>
            </div>
        </div>
    </nav>
    
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Gestión de Grupos</h2>
            <a href="grupos.php?action=crear" class="btn btn-success">Crear Grupo</a>
        </div>
        
        <div class="table-responsive mt-3">
            <table class="table table-striped">
                <thead>
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
</body>
</html>