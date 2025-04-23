<?php
require 'db.php';
require 'session.php';
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
if (!isAdmin()) {
  header('Location: index.php');
  exit();
}
$users = $pdo->query("SELECT id, username, role FROM users")->fetchAll();
?>

<!DOCTYPE html>
<html lang="mn">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
  <h2 class="mb-4 text-center">🛠 Admin Panel</h2>

  <div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>Role</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $user): ?>
          <tr>
            <td><?= $user['id'] ?></td>
            <td><?= htmlspecialchars($user['username']) ?></td>
            <td><?= $user['role'] ?></td>
            <td>
              <a href="edit_user.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-primary">Засах</a>
              <a href="delete_user.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-danger"
                 onclick="return confirm('Та энэ хэрэглэгчийг устгахдаа итгэлтэй байна уу?');">Устгах</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <h3 class="mt-5">Админ удирдлагын хэсэг</h3>
  <ul class="list-group list-group-flush mb-4">
    <li class="list-group-item">
      <a href="admin_orders.php" class="text-decoration-none">📋 Захиалгуудыг харах</a>
    </li>
    <li class="list-group-item">
      <a href="logout.php" class="text-decoration-none text-danger">🚪 Гарах</a>
    </li>
  </ul>

  <a href="index.php" class="btn btn-secondary">← Буцах</a>
</div>

</body>
</html>
