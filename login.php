<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'config/database.php';

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email']);
    $password = $_POST['password'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Email atau password salah.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - To Do List</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome 6 CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #e0eafc 0%, #cfdef3 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card-login {
            border-radius: 1.5rem;
            box-shadow: 0 8px 32px 0 rgba(31,38,135,0.12);
            background: #fff;
            padding: 2.5rem 2rem 2rem 2rem;
            margin: 2rem 0;
            width: 100%;
            max-width: 380px;
        }
        .card-login .logo-circle {
            width: 60px; height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #86a8e7 0%, #7f7fd5 100%);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1rem auto;
            font-size: 2rem;
            color: #fff;
            box-shadow: 0 2px 12px rgba(134,168,231,0.18);
        }
        .form-control:focus {
            border-color: #86a8e7;
            box-shadow: 0 0 0 0.15rem #86a8e722;
        }
        .btn-primary {
            background: linear-gradient(90deg, #7f7fd5 0%, #86a8e7 100%);
            border: none;
            transition: 0.2s;
        }
        .btn-primary:hover {
            background: linear-gradient(90deg, #86a8e7 0%, #7f7fd5 100%);
            transform: translateY(-2px) scale(1.04);
            box-shadow: 0 4px 18px rgba(134,168,231,0.12);
        }
        .input-group-text {
            background: #f3f7fa;
            border-radius: 8px 0 0 8px;
            border: none;
            color: #7f7fd5;
        }
        .form-label {
            font-weight: 500;
            color: #31425b;
        }
        .register-link {
            color: #7f7fd5;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }
        .register-link:hover {
            color: #4c55a8;
            text-decoration: underline;
        }
        .alert {
            border-radius: 1rem;
            font-size: 1rem;
        }
        @media (max-width: 600px) {
            .card-login { padding: 1.5rem 0.5rem; }
        }
    </style>
</head>
<body>
    <main class="d-flex flex-column justify-content-center align-items-center min-vh-100">
        <div class="card-login shadow-lg">
            <div class="logo-circle mb-2">
                <i class="fa-solid fa-list-check"></i>
            </div>
            <h2 class="mb-4 text-center fw-bold" style="font-size:1.5rem;">Login To Do List</h2>
            <?php if ($error): ?>
                <div class="alert alert-danger text-center mb-3 py-2">
                    <i class="fa-solid fa-triangle-exclamation"></i> <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            <form method="POST" autocomplete="on">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                        <input type="email" name="email" id="email" class="form-control" required placeholder="Email address" autocomplete="username" autofocus>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" name="password" id="password" class="form-control" required placeholder="Password" autocomplete="current-password">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2 mt-2 fs-5 shadow-sm">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i> Login
                </button>
            </form>
            <div class="text-center mt-4">
                <span>Belum punya akun? </span>
                <a href="register.php" class="register-link">Register</a>
            </div>
        </div>
    </main>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
