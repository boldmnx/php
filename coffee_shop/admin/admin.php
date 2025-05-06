<?php
require_once '../db/db.php';
require '../db/session.php';
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
if (!isAdmin()) {
  header('Location: /coffee_shop/index.php');
  exit();
}

// Кофены мэдээллийг авах
$coffees = $pdo->query("SELECT id, name, price, average_rating FROM menu")->fetchAll();

ob_start();
?>

<h2 class="mb-4 text-center">🛠 Админ Панель - Кофе Удирдлага</h2>

<div class="table-responsive">
  <table class="table table-bordered table-striped align-middle">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Нэр</th>
        <th>Үнэ</th>
        <th>Үнэлгээ</th>
        <th>Үйлдлүүд</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($coffees as $coffee): ?>
        <tr>
          <td><?= $coffee['id'] ?></td>
          <td><?= htmlspecialchars($coffee['name']) ?></td>
          <td><?= $coffee['price'] ?>₮</td>
          <td><?= number_format($coffee['average_rating'], 1) ?> ★</td>
          <td>
            <a href="/coffee_shop/coffee/add_coffee.php?id=<?= $coffee['id'] ?>" class="btn btn-sm btn-success">Нэмэх</a>
            <a href="/coffee_shop/coffee/edit_coffee.php?id=<?= $coffee['id'] ?>" class="btn btn-sm btn-primary">Засах</a>
            <a href="/coffee_shop/coffee/delete_coffee.php?id=<?= $coffee['id'] ?>" class="btn btn-sm btn-danger"
               onclick="return confirm('Та энэ кофены мэдээллийг устгахдаа итгэлтэй байна уу?');">Устгах</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<h3 class="mt-5">Админ удирдлагын хэсэг</h3>
<ul class="list-group list-group-flush mb-4">
  <li class="list-group-item">
    <a href="/coffee_shop/admin/admin_orders.php" class="text-decoration-none">📋 Захиалгуудыг харах</a>
  </li>
  <li class="list-group-item">
    <a href="/coffee_shop/auth/logout.php" class="text-decoration-none text-danger">🚪 Гарах</a>
  </li>
</ul>

<a href="/coffee_shop/index.php" class="btn btn-secondary">← Буцах</a>

<?php
$content = ob_get_clean();
include '../layout.php';
?>
