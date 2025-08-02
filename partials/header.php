<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>To-Do List</title>
  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- FontAwesome 6 CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    .navbar-todo {
      background: linear-gradient(90deg, #7f7fd5 0%, #86a8e7 100%);
      box-shadow: 0 4px 16px 0 rgba(80,100,255,0.07);
      border-bottom-left-radius: 1.3rem;
      border-bottom-right-radius: 1.3rem;
      padding-top: .4rem;
      padding-bottom: .4rem;
      min-height: 64px;
    }
    .navbar-todo .navbar-brand {
      font-size: 1.45rem;
      font-weight: 700;
      letter-spacing: 0.5px;
      color: #fff !important;
      display: flex;
      align-items: center;
      gap: 10px;
      text-shadow: 0 1px 8px #7f7fd522;
    }
    .navbar-todo .fa-clipboard-check {
      font-size: 1.4em;
      color: #eaf6ff;
      margin-right: 2px;
    }
    .navbar-todo .user-info {
      color: #f4f6fc;
      font-size: 1.08rem;
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .navbar-todo .btn-logout {
      border-radius: 2rem;
      padding: 0.4em 1.3em;
      font-weight: 500;
      background: linear-gradient(90deg, #f85032 0%, #e73827 100%);
      color: #fff;
      border: none;
      box-shadow: 0 2px 12px #e7382722;
      transition: all 0.18s;
      font-size: 1em;
    }
    .navbar-todo .btn-logout:hover, .navbar-todo .btn-logout:focus {
      background: linear-gradient(90deg, #e73827 0%, #f85032 100%);
      color: #fff;
      box-shadow: 0 4px 18px #e7382740;
      transform: translateY(-1px) scale(1.04);
      outline: none;
    }
    /* Responsive: tombol logout jadi icon di mobile */
    @media (max-width: 600px) {
      .navbar-todo .user-name-text {
        display: none;
      }
      .navbar-todo .btn-logout-text {
        display: none;
      }
      .navbar-todo .btn-logout {
        padding: .4em .8em;
        font-size: 1.2em;
      }
    }
  </style>
</head>
<body style="background: #e0eafc;">
<nav class="navbar navbar-todo mb-4">
  <div class="container-fluid px-3">
    <a class="navbar-brand" href="#">
      <i class="fa-solid fa-clipboard-check"></i>
      To-Do List App
    </a>
    <div class="user-info">
      <span class="user-name-text">
        <i class="fa-solid fa-user-circle"></i> Hai, <?= htmlspecialchars($_SESSION['user_name']) ?>
      </span>
      <a href="logout.php" class="btn btn-logout d-flex align-items-center" title="Logout">
        <span class="btn-logout-text"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</span>
        <span class="d-md-none"><i class="fa-solid fa-arrow-right-from-bracket"></i></span>
      </a>
    </div>
  </div>
</nav>
<div class="container my-4">
