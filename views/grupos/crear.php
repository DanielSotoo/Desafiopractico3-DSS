<?php
// views/grupos/crear.php
?>
<!DOCTYPE html>
<html>
<head>
    <title>Crear Grupo</title>
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
        <h2>Crear Nuevo Grupo</h2>
        
        <form method="post" class="mt-3">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Grupo</label>
                <input type="text" class="form-control" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="codigo_tutor" class="form-label">Tutor</label>
                <select class="form-control" name="codigo_tutor" required>
                    <option value="">Seleccionar tutor...</option>
                    <?php foreach($tutores as $tutor): ?>
                        <option value="<?= $tutor['codigo'] ?>"><?= $tutor['nombres'] . ' ' . $tutor['apellidos'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Crear Grupo</button>
            <a href="grupos.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
