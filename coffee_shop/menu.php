<?php
require 'db.php';
require 'session.php';

if (!isAdmin()) {
  header('Location: index.php');
  exit();
}
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 5;
$offset = ($page - 1) * $limit;

$sort = isset($_GET['sort']) ? $_GET['sort'] : 'name';

switch ($sort) {
  case 'price':
    $orderBy = 'price ASC';
    break;
  case 'rating':
    $orderBy = 'average_rating DESC';
    break;
  default:
    $orderBy = 'name ASC';
    break;
}

$items = $pdo->prepare("SELECT * FROM menu ORDER BY $orderBy LIMIT :limit OFFSET :offset");
$items->bindValue(':limit', $limit, PDO::PARAM_INT);
$items->bindValue(':offset', $offset, PDO::PARAM_INT);
$items->execute();

$total = $pdo->query("SELECT COUNT(*) FROM menu")->fetchColumn();
$pages = ceil($total / $limit);
?>

<!DOCTYPE html>
<html lang="mn">
<head>
  <meta charset="UTF-8">
  <title>Меню</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
  <h2 class="mb-4 text-center">🍰 Цэс</h2>

  <!-- Сортлох dropdown -->
  <form method="GET" action="menu.php" class="mb-4 d-flex align-items-center gap-3">
    <label for="sort" class="form-label mb-0">Сортлох:</label>
    <select name="sort" class="form-select w-auto" onchange="this.form.submit()">
      <option value="name" <?= $sort === 'name' ? 'selected' : '' ?>>Нэрээр</option>
      <option value="price" <?= $sort === 'price' ? 'selected' : '' ?>>Үнэ өсөхөөр</option>
      <option value="rating" <?= $sort === 'rating' ? 'selected' : '' ?>>Үнэлгээгээр</option>
    </select>
    <input type="hidden" name="page" value="<?= $page ?>">
  </form>

  <!-- Бүтээгдэхүүний жагсаалт -->
  <div class="row row-cols-1 row-cols-md-2 g-4">
    <?php foreach ($items as $item): ?>
      <div class="col">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($item['name']) ?></h5>
            <p class="card-text text-muted">Үнэ: <?= $item['price'] ?>₮</p>
            <p class="card-text">Үнэлгээ: <?= number_format($item['average_rating'], 1) ?> ★</p>

            <!-- Үнэлгээ өгөх -->
            <form method="post" action="rate.php" class="d-flex align-items-center mb-2 gap-2">
              <input type="hidden" name="menu_id" value="<?= $item['id'] ?>">
              <select name="rating" class="form-select w-auto">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                  <option value="<?= $i ?>"><?= $i ?>★</option>
                <?php endfor; ?>
              </select>
              <button type="submit" class="btn btn-sm btn-outline-warning">Үнэлэх</button>
            </form>

            <!-- Захиалга өгөх -->
            <form method="post" action="order.php" class="d-flex align-items-center gap-2">
              <input type="hidden" name="menu_id" value="<?= $item['id'] ?>">
              <label class="form-label mb-0">Тоо:</label>
              <input type="number" name="quantity" value="0" min="1" required class="form-control w-25">
              <button type="submit" class="btn btn-sm btn-success">Захиалах</button>
            </form>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Хуудасжуулалт -->
  <nav class="mt-4">
    <ul class="pagination justify-content-center">
      <?php for ($i = 1; $i <= $pages; $i++): ?>
        <li class="page-item <?= $i === $page ? 'active' : '' ?>">
          <a class="page-link" href="?page=<?= $i ?>&sort=<?= $sort ?>">Хуудас <?= $i ?></a>
        </li>
      <?php endfor; ?>
    </ul>
  </nav>

  <div class="text-center mt-4">
    <a href="index.php" class="btn btn-secondary">← Буцах</a>
  </div>
</div>

</body>
</html>
