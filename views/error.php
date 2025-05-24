<?php
// views/error.php
?>
<!DOCTYPE html>
<html>
<head>
    <title>Error</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-danger">
            <h4>Error</h4>
            <p><?= $error ?></p>
            <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</body>
</html>