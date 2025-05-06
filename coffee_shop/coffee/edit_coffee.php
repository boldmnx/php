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

if (isset($_GET['id'])) {
  $coffee_id = $_GET['id'];
  $coffee = $pdo->prepare("SELECT * FROM menu WHERE id = :id");
  $coffee->bindValue(':id', $coffee_id, PDO::PARAM_INT);
  $coffee->execute();
  $coffee = $coffee->fetch();

  if (!$coffee) {
    header('Location: /coffee_shop/admin/admin_coffees.php');
    exit();
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $average_rating = $_POST['average_rating'];

  $updateStmt = $pdo->prepare("UPDATE menu SET name = :name, price = :price, average_rating = :average_rating WHERE id = :id");
  $updateStmt->bindValue(':name', $name, PDO::PARAM_STR);
  $updateStmt->bindValue(':price', $price, PDO::PARAM_INT);
  $updateStmt->bindValue(':average_rating', $average_rating, PDO::PARAM_STR);
  $updateStmt->bindValue(':id', $coffee_id, PDO::PARAM_INT);
  $updateStmt->execute();

  header('Location: /coffee_shop/admin/admin.php');
  exit();
}

ob_start();
?>

<h2 class="mb-4 text-center">Кофе Засах</h2>

<form method="POST">
  <div class="mb-3">
    <label for="name" class="form-label">Нэр</label>
    <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($coffee['name']) ?>" required>
  </div>
  <div class="mb-3">
    <label for="price" class="form-label">Үнэ</label>
    <input type="number" class="form-control" id="price" name="price" value="<?= $coffee['price'] ?>" required>
  </div>
  <div class="mb-3">
    <label for="average_rating" class="form-label">Үнэлгээ</label>
    <input type="number" class="form-control" id="average_rating" name="average_rating" value="<?= $coffee['average_rating'] ?>" step="0.1" min="0" max="5" required>
  </div>
  <button type="submit" class="btn btn-success">Хадгалах</button>
  <a href="/coffee_shop/admin/admin.php" class="btn btn-secondary">Буцах</a>
</form>

<?php
$content = ob_get_clean();
include '../layout.php';
?>
