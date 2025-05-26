<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asignar Estudiantes</title>
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
        .assign-card {
            max-width: 800px;
            margin: 2rem auto;
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.08);
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
                <a class="nav-link text-white" href="grupos.php">Grupos</a>
                <a class="nav-link text-white" href="logout.php">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <div class="section-title-bar">
        ASIGNAR ESTUDIANTES AL GRUPO
    </div>

    <div class="main-content">
        <div class="assign-card">
            <form method="post">
                <div class="row">
                    <?php foreach($estudiantes as $estudiante): ?>
                        <div class="col-md-6 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="estudiantes[]" value="<?= $estudiante['codigo'] ?>" id="est_<?= $estudiante['codigo'] ?>">
                                <label class="form-check-label" for="est_<?= $estudiante['codigo'] ?>">
                                    <?= $estudiante['nombres'] . ' ' . $estudiante['apellidos'] ?>
                                </label>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-success">Asignar Estudiantes</button>
                    <a href="grupos.php" class="btn btn-secondary">Cancelar</a>
                </div>
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
