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

// Хэрэглэгчийн ID-ийг авч байна
if (isset($_GET['id'])) {
  $user_id = (int)$_GET['id'];
  $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
  $stmt->execute([$user_id]);
  $user = $stmt->fetch();

  if (!$user) {
    die("Хэрэглэгч олдсонгүй");
  }
}

// Хэрэглэгчийн мэдээллийг засах үйлдэл
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $role = $_POST['role'];

  // Мэдээллийг шинэчилнэ
  $stmt = $pdo->prepare("UPDATE users SET username = ?, role = ? WHERE id = ?");
  $stmt->execute([$username, $role, $user_id]);

  header('Location: admin.php'); // Зассан хэрэглэгчийн жагсаалт руу шилжих
  exit();
}
?>

<!DOCTYPE html>
<html lang="mn">
<head>
  <meta charset="UTF-8">
  <title>Хэрэглэгчийг засах</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
  <h2 class="text-center mb-4">Хэрэглэгчийг засах</h2>

  <form method="POST">
    <div class="mb-3">
      <label for="username" class="form-label">Нэр:</label>
      <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="role" class="form-label">Үүрэг:</label>
      <select name="role" class="form-select" required>
        <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Админ</option>
        <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>Хэрэглэгч</option>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Засах</button>
  </form>

  <a href="admin.php" class="btn btn-secondary mt-3">Буцах</a>
</div>

</body>
</html>
