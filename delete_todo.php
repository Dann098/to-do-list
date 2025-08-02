<?php
session_start();
require 'config/database.php';
if (isset($_GET['id']) && isset($_SESSION['user_id'])) {
    $id = $_GET['id'];
    $user_id = $_SESSION['user_id'];
    $pdo->prepare("DELETE FROM todos WHERE id=? AND user_id=?")->execute([$id, $user_id]);
}
header("Location: dashboard.php");
exit;
?>
