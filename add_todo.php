<?php
session_start();
require 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $user_id    = $_SESSION['user_id'];
    $nama_tugas = trim($_POST['nama_tugas']);
    $prioritas  = $_POST['prioritas'];
    $kategori   = $_POST['kategori'];
    $deadline   = $_POST['deadline'];

    if ($nama_tugas && $prioritas && $kategori && $deadline) {
        $stmt = $pdo->prepare("INSERT INTO todos (user_id, nama_tugas, prioritas, kategori, deadline) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$user_id, $nama_tugas, $prioritas, $kategori, $deadline]);
    }
}
header("Location: dashboard.php");
exit;
?>
