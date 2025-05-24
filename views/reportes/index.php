<?php
// views/reportes/index.php
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reportes</title>
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
        <h2>Generar Reporte Trimestral</h2>
        
        <div class="card mt-3">
            <div class="card-body">
                <form method="post">
                    <div class="mb-3">
                        <label for="codigo_estudiante" class="form-label">Estudiante</label>
                        <select class="form-control" name="codigo_estudiante" required>
                            <option value="">Seleccionar estudiante...</option>
                            <?php foreach($estudiantes as $estudiante): ?>
                                <option value="<?= $estudiante['codigo'] ?>"><?= $estudiante['nombres'] . ' ' . $estudiante['apellidos'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="trimestre" class="form-label">Trimestre</label>
                        <select class="form-control" name="trimestre" required>
                            <option value="">Seleccionar trimestre...</option>
                            <option value="1">Primer Trimestre (Feb-Abr)</option>
                            <option value="2">Segundo Trimestre (May-Jul)</option>
                            <option value="3">Tercer Trimestre (Ago-Oct)</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Generar Reporte PDF</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>