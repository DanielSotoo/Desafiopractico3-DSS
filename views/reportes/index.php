<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reportes</title>
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
            max-width: 700px;
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
        .btn-success {
            background-color: #dc3545;
            border: none;
            font-weight: bold;
        }
        .btn-success:hover {
            background-color: #bb2d3b;
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
        GENERAR REPORTE TRIMESTRAL
    </div>

    <div class="main-content">
        <div class="form-container">
            <form method="post">
                <div class="mb-3">
                    <label for="codigo_estudiante" class="form-label">Estudiante</label>
                    <select class="form-select" name="codigo_estudiante" required>
                        <option value="">Seleccionar estudiante...</option>
                        <?php foreach($estudiantes as $estudiante): ?>
                            <option value="<?= $estudiante['codigo'] ?>">
                                <?= $estudiante['nombres'] . ' ' . $estudiante['apellidos'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="trimestre" class="form-label">Trimestre</label>
                    <select class="form-select" name="trimestre" required>
                        <option value="">Seleccionar trimestre...</option>
                        <option value="1">Primer Trimestre (Feb - Abr)</option>
                        <option value="2">Segundo Trimestre (May - Jul)</option>
                        <option value="3">Tercer Trimestre (Ago - Oct)</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success w-100 py-2">GENERAR PDF</button>
            </form>
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
