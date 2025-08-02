<?php
session_start();
require 'config/database.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm'];

    // Validation
    if (!$name || !$email || !$password || !$confirm) {
        $errors[] = "Semua field wajib diisi.";
    }
    if ($password !== $confirm) {
        $errors[] = "Password tidak cocok.";
    }

    // Register
    if (!$errors) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$email]);
        if ($stmt->rowCount()) {
            $errors[] = "Email sudah terdaftar.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)")
                ->execute([$name, $email, $hash]);
            header("Location: login.php?register=success");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - To Do List</title>
    <!-- Bootstrap 5 CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- FontAwesome CDN -->
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
        .card-register {
            border-radius: 1.5rem;
            box-shadow: 0 8px 32px 0 rgba(134,168,231,0.18);
            background: #fff;
            padding: 2.5rem 2rem 2rem 2rem;
            margin: 2rem 0;
            width: 100%;
            max-width: 410px;
        }
        .logo-circle {
            width: 62px; height: 62px;
            border-radius: 50%;
            background: linear-gradient(135deg, #86a8e7 0%, #7f7fd5 100%);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.2rem auto;
            font-size: 2rem;
            color: #fff;
            box-shadow: 0 2px 12px rgba(134,168,231,0.18);
        }
        .form-label {
            font-weight: 500;
            color: #31425b;
        }
        .form-control:focus {
            border-color: #86a8e7;
            box-shadow: 0 0 0 0.15rem #86a8e733;
        }
        .btn-primary {
            background: linear-gradient(90deg, #7f7fd5 0%, #86a8e7 100%);
            border: none;
            font-weight: 600;
            font-size: 1.13em;
            padding: 0.7em 1em;
            transition: 0.22s;
        }
        .btn-primary:hover, .btn-primary:focus {
            background: linear-gradient(90deg, #86a8e7 0%, #7f7fd5 100%);
            transform: translateY(-1.5px) scale(1.03);
            box-shadow: 0 4px 18px rgba(134,168,231,0.15);
        }
        .alert {
            border-radius: 1rem;
            font-size: 1.01em;
            margin-bottom: 1.3rem;
            box-shadow: 0 2px 10px #d04c4c18;
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
        .toggle-password {
            cursor: pointer;
            color: #9bb8de;
            transition: color 0.15s;
        }
        .toggle-password:hover { color: #7f7fd5; }
        @media (max-width: 600px) {
            .card-register { padding: 1.5rem 0.5rem; }
        }
    </style>
</head>
<body>
<main class="d-flex flex-column justify-content-center align-items-center min-vh-100">
    <div class="card-register shadow-lg">
        <div class="logo-circle mb-2">
            <i class="fa-solid fa-user-plus"></i>
        </div>
        <h2 class="mb-4 text-center fw-bold" style="font-size:1.48rem;">Register Akun To-Do List</h2>
        <?php if ($errors): ?>
            <div class="alert alert-danger text-center mb-3 py-2">
                <i class="fa-solid fa-triangle-exclamation me-1"></i>
                <?php foreach ($errors as $err) echo htmlspecialchars($err) . '<br>'; ?>
            </div>
        <?php endif; ?>
        <form method="POST" autocomplete="on">
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" name="name" id="name" class="form-control" required
                    placeholder="Nama lengkap" value="<?= isset($name) ? htmlspecialchars($name) : '' ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required
                    placeholder="Alamat email" value="<?= isset($email) ? htmlspecialchars($email) : '' ?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control" required placeholder="Password" autocomplete="new-password">
                    <span class="input-group-text bg-white border-start-0 toggle-password" onclick="togglePass('password', this)">
                        <i class="fa-solid fa-eye"></i>
                    </span>
                </div>
            </div>
            <div class="mb-3">
                <label for="confirm" class="form-label">Konfirmasi Password</label>
                <div class="input-group">
                    <input type="password" name="confirm" id="confirm" class="form-control" required placeholder="Ulangi password" autocomplete="new-password">
                    <span class="input-group-text bg-white border-start-0 toggle-password" onclick="togglePass('confirm', this)">
                        <i class="fa-solid fa-eye"></i>
                    </span>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-2 shadow-sm">
                <i class="fa-solid fa-user-plus me-1"></i> Register
            </button>
        </form>
        <div class="text-center mt-4">
            <span>Sudah punya akun? </span>
            <a href="login.php" class="register-link">Login</a>
        </div>
    </div>
</main>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Show/Hide Password Script -->
<script>
function togglePass(id, el) {
    var inp = document.getElementById(id);
    var icon = el.querySelector('i');
    if (inp.type === "password") {
        inp.type = "text";
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        inp.type = "password";
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>
</body>
</html>
