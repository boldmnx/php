<?php
require_once '../db/db.php';
require_once '../db/session.php';
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
if (!isAdmin()) {
  header("Location: /coffee_shop/auth/login.php");
  exit();
}

$stmt = $pdo->query("
    SELECT o.id, m.name, u.username,  o.quantity, m.price, o.total_price, o.created_at 
    FROM orders o
    JOIN menu m ON o.menu_id = m.id
    LEFT JOIN users u ON o.user_id = u.id
    ORDER BY o.created_at DESC
");
$orders = $stmt->fetchAll();
ob_start();
?>
<h2 class="text-center mb-4">Захиалгын жагсаалт</h2>

<div class="table-responsive">
  <table class="table table-bordered table-striped align-middle">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>Бүтээгдэхүүн</th>
        <th>Захиалагч</th>
        <th>Тоо ширхэг</th>
        <th>Ширхэгийн үнэ</th>
        <th>Нийт үнэ (₮)</th>
        <th>Огноо</th>
        <th>Үйлдэл</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($orders as $i => $order): ?>
        <tr>
          <td><?= $i + 1 ?></td>
          <td><?= htmlspecialchars($order['name']) ?></td>
          <td><?= !empty($order['username']) ? htmlspecialchars($order['username']) : 'guest' ?></td>
          <td><?= $order['quantity'] ?></td>
          <td><?= $order['price'] ?></td>
          <td><?= $order['total_price'] ?></td>
          <td><?= $order['created_at'] ?></td>
          <td>
            <a href="/coffee_shop/admin/delete_order.php?id=<?= $order['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Та энэ захиалгыг устгахдаа итгэлтэй байна уу?');">Цуцлах</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<a href="/coffee_shop/admin/admin.php" class="btn btn-secondary">← Буцах</a>

<?php $content = ob_get_clean();
include '../layout.php';
