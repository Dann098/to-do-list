<?php
session_start();
require 'config/database.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Handle search & filter
$where = "user_id = ?";
$params = [$_SESSION['user_id']];
$search = '';
$filter = '';

if (!empty($_GET['search'])) {
    $search = trim($_GET['search']);
    $where .= " AND nama_tugas LIKE ?";
    $params[] = "%$search%";
}

if (!empty($_GET['filter'])) {
    $filter = $_GET['filter'];
    switch ($filter) {
        case 'aktif':
            $where .= " AND status = 'aktif'";
            break;
        case 'selesai':
            $where .= " AND status = 'selesai'";
            break;
        case 'today':
            $where .= " AND deadline = CURDATE()";
            break;
        case 'tinggi':
            $where .= " AND prioritas = 'tinggi'";
            break;
    }
}

// Query todo list
$todos = $pdo->prepare("SELECT * FROM todos WHERE $where ORDER BY deadline ASC, created_at DESC");
$todos->execute($params);
$todoList = $todos->fetchAll();
?>
<!-- Dashboard UI (dashboard.php, potongan utama) -->
<?php include 'partials/header.php'; ?>
<h3>Tambah Tugas</h3>
<form action="add_todo.php" method="post" class="row g-3 mb-4">
  <div class="col-md-4">
    <input type="text" name="nama_tugas" class="form-control" placeholder="Nama Tugas" required>
  </div>
  <div class="col-md-2">
    <select name="prioritas" class="form-select" required>
      <option value="rendah">Rendah</option>
      <option value="sedang">Sedang</option>
      <option value="tinggi">Tinggi</option>
    </select>
  </div>
  <div class="col-md-2">
    <select name="kategori" class="form-select" required>
      <option value="pribadi">Pribadi</option>
      <option value="kelompok">Kelompok</option>
      <option value="lainnya">Lainnya</option>
    </select>
  </div>
  <div class="col-md-2">
    <input type="date" name="deadline" class="form-control" required>
  </div>
  <div class="col-md-2">
    <button class="btn btn-primary w-100" type="submit">Tambah Tugas</button>
  </div>
</form>

<!-- Search & Filter -->
<form class="row g-3 mb-3" method="get" action="">
  <div class="col-md-4">
    <input type="text" name="search" class="form-control" value="<?= htmlspecialchars($search) ?>" placeholder="Cari tugas...">
  </div>
  <div class="col-md-8">
    <div class="btn-group" role="group">
      <a href="?filter=all" class="btn btn-outline-secondary <?= !$filter ? 'active' : '' ?>">Semua</a>
      <a href="?filter=aktif" class="btn btn-outline-secondary <?= $filter=='aktif' ? 'active' : '' ?>">Aktif</a>
      <a href="?filter=selesai" class="btn btn-outline-secondary <?= $filter=='selesai' ? 'active' : '' ?>">Selesai</a>
      <a href="?filter=today" class="btn btn-outline-secondary <?= $filter=='today' ? 'active' : '' ?>">Hari Ini</a>
      <a href="?filter=tinggi" class="btn btn-outline-secondary <?= $filter=='tinggi' ? 'active' : '' ?>">Prioritas Tinggi</a>
    </div>
  </div>
</form>

<!-- List Tugas -->
<table class="table table-bordered">
  <thead>
    <tr>
      <th>Nama Tugas</th>
      <th>Prioritas</th>
      <th>Kategori</th>
      <th>Deadline</th>
      <th>Status</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($todoList as $todo): ?>
    <tr>
      <td><?= htmlspecialchars($todo['nama_tugas']) ?></td>
      <td><?= ucfirst($todo['prioritas']) ?></td>
      <td><?= ucfirst($todo['kategori']) ?></td>
      <td><?= $todo['deadline'] ?></td>
      <td>
        <?php if ($todo['status'] === 'selesai'): ?>
          <span class="badge bg-success">Selesai</span>
        <?php else: ?>
          <span class="badge bg-warning text-dark">Aktif</span>
        <?php endif; ?>
      </td>
      <td>
        <?php if ($todo['status'] === 'aktif'): ?>
          <a href="complete_todo.php?id=<?= $todo['id'] ?>" class="btn btn-success btn-sm">Tandai Selesai</a>
        <?php endif; ?>
        <a href="delete_todo.php?id=<?= $todo['id'] ?>" onclick="return confirm('Hapus tugas ini?')" class="btn btn-danger btn-sm">Hapus</a>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<?php include 'partials/footer.php'; ?>

<!-- HTML: Form tambah, tampilkan tugas, tombol aksi, search & filter -->
