<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asistencia - Academia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f3f6fa;
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
        .form-container {
            max-width: 900px;
            margin: 3rem auto;
            padding: 2rem;
            background: white;
            border-radius: 1rem;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        }
        .form-label {
            font-weight: 600;
            color: #2c3e50;
        }
        .table thead {
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
            <a class="navbar-brand" href="#">ACADEMIA - TUTOR</a>
            <div class="d-flex">
                <span class="navbar-text text-white me-3">Bienvenido, <?= $_SESSION['username'] ?></span>
                <a class="nav-link text-white" href="logout.php">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <div class="section-title-bar">
        TOMAR ASISTENCIA - <?= date('d/m/Y') ?>
    </div>

    <div class="main-content">
        <div class="form-container">
            <?php if (isset($mensaje)): ?>
                <div class="alert alert-success"><?= $mensaje ?></div>
            <?php endif; ?>

            <?php if (isset($grupo) && $grupo): ?>
                <h5 class="mb-4"><strong>Grupo:</strong> <?= $grupo['nombre'] ?></h5>
                <form method="post">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Estudiante</th>
                                    <th>Asistencia</th>
                                    <th>Aspecto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($estudiantes as $estudiante): ?>
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
                                                <?php foreach ($aspectos as $aspecto): ?>
                                                    <option value="<?= $aspecto['id'] ?>">[<?= $aspecto['tipo'] ?>] <?= $aspecto['descripcion'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3">REGISTRAR ASISTENCIA</button>
                </form>
            <?php else: ?>
                <div class="alert alert-warning mt-3">No tienes un grupo asignado.</div>
            <?php endif; ?>
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
