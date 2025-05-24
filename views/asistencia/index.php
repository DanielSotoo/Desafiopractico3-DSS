<?php
// views/asistencia/index.php
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tomar Asistencia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="#">Academia - Tutor</a>
            <div class="navbar-nav ms-auto">
                <span class="navbar-text me-3">Bienvenido, <?= $_SESSION['username'] ?></span>
                <a class="nav-link" href="logout.php">Cerrar Sesión</a>
            </div>
        </div>
    </nav>
    
    <div class="container mt-4">
        <h2>Tomar Asistencia - <?= date('d/m/Y') ?></h2>
        
        <?php if(isset($mensaje)): ?>
            <div class="alert alert-success"><?= $mensaje ?></div>
        <?php endif; ?>
        
        <?php if(isset($grupo) && $grupo): ?>
        <div class="card">
            <div class="card-header">
                <h5>Grupo: <?= $grupo['nombre'] ?></h5>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Estudiante</th>
                                    <th>Asistencia</th>
                                    <th>Aspecto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($estudiantes as $estudiante): ?>
                                <tr>
                                    <td><?= $estudiante['nombres'] . ' ' . $estudiante['apellidos'] ?></td>
                                    <td>
                                        <select name="asistencia[<?= $estudiante['codigo'] ?>]" class="form-select form-select-sm">
                                            <option value="A">Asistió</option>
                                            <option value="I">Inasistencia</option>
                                            <option value="J">Justificado</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="aspectos[<?= $estudiante['codigo'] ?>][]" class="form-select form-select-sm">
                                            <option value="">Sin aspecto</option>
                                            <?php foreach($aspectos as $aspecto): ?>
                                                <option value="<?= $aspecto['id'] ?>">[<?= $aspecto['tipo'] ?>] <?= $aspecto['descripcion'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar Asistencia</button>
                </form>
            </div>
        </div>
        <?php else: ?>
            <div class="alert alert-warning">No tienes un grupo asignado.</div>
        <?php endif; ?>
    </div>
</body>
</html>