<?php
// views/grupos/asignar.php
?>
<!DOCTYPE html>
<html>
<head>
    <title>Asignar Estudiantes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">Academia</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="grupos.php">Grupos</a>
                <a class="nav-link" href="logout.php">Cerrar Sesión</a>
            </div>
        </div>
    </nav>
    
    <div class="container mt-4">
        <h2>Asignar Estudiantes al Grupo</h2>
        
        <form method="post" class="mt-3">
            <div class="row">
                <?php foreach($estudiantes as $estudiante): ?>
                <div class="col-md-6 mb-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="estudiantes[]" value="<?= $estudiante['codigo'] ?>" id="est_<?= $estudiante['codigo'] ?>">
                        <label class="form-check-label" for="est_<?= $estudiante['codigo'] ?>">
                            <?= $estudiante['nombres'] . ' ' . $estudiante['apellidos'] ?>
                        </label>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <button type="submit" class="btn btn-success mt-3">Asignar Estudiantes</button>
            <a href="grupos.php" class="btn btn-secondary mt-3">Cancelar</a>
        </form>
    </div>
</body>
</html>