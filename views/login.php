<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión - Academia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('https://images.pexels.com/photos/6238050/pexels-photo-6238050.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');
            background-size: cover;
            background-position: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .login-card {
            display: flex;
            flex-direction: row;
            border: none;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(4px);
            min-height: 700px;
        }
        .login-left {
            background-color: #0d6efd;
            color: white;
            padding: 3rem;
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
        }
        .login-left h4 {
            font-size: 2.2rem;
            font-weight: bold;
        }
        .login-left p {
            font-size: 1.2rem;
            opacity: 0.95;
        }
        .login-right {
            background-color: rgba(255, 255, 255, 0.96);
            padding: 3rem;
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .btn-login {
            background-color: #0d6efd;
            border: none;
        }
        .btn-login:hover {
            background-color: #0b5ed7;
        }
        .helper-text {
            font-size: 0.9rem;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="login-card col-md-10 col-lg-8">
            <div class="login-left">
                <h4>Academia Escolar</h4>
                <p>Inicio de sesión</p>
            </div>
            <div class="login-right">
                <?php if(isset($error)): ?>
                    <div class="alert alert-danger text-center"><?= $error ?></div>
                <?php endif; ?>

                <form method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Usuario</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <button type="submit" class="btn btn-login w-100">Ingresar</button>
                </form>

                <div class="text-center mt-3 helper-text">
                    <p><strong>Demo:</strong><br>Admin: <code>admin</code> / Tutor: <code>tutor01</code><br>Contraseña: <code>password</code></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
