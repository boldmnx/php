<?php
// functions.php файлыг зөв оруулж байгаа эсэхийг шалгана
require 'session.php';

// Сессийг шалгах
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isAdmin()) {
    header("Location: login.php");
    exit();
}

require 'db.php';

// Захиалгын мэдээллийг авах
$stmt = $pdo->query("
    SELECT o.id, m.name, o.quantity, o.total_price, o.created_at 
    FROM orders o
    JOIN menu m ON o.menu_id = m.id
    ORDER BY o.created_at DESC
");
$orders = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="mn">
<head>
  <meta charset="UTF-8">
  <title>Захиалгын жагсаалт</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
  <h2 class="text-center mb-4">Захиалгын жагсаалт</h2>

  <div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
      <thead class="table-dark">
        <tr>
          <th>#</th>
          <th>Бүтээгдэхүүн</th>
          <th>Тоо ширхэг</th>
          <th>Нийт үнэ (₮)</th>
          <th>Огноо</th>
          <th>Үйлдэл</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($orders as $order): ?>
          <tr>
            <td><?= $order['id'] ?></td>
            <td><?= htmlspecialchars($order['name']) ?></td>
            <td><?= $order['quantity'] ?></td>
            <td><?= $order['total_price'] ?></td>
            <td><?= $order['created_at'] ?></td>
            <td>
              <a href="delete_order.php?id=<?= $order['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Та энэ захиалгыг устгахдаа итгэлтэй байна уу?');">Цуцлах</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <a href="admin.php" class="btn btn-secondary">← Буцах</a>
</div>

</body>
</html>
