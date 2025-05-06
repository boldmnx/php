<?php
require '../db/db.php';
require '../db/session.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_name = uniqid() . '_' . $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_path = '../uploads/' . $image_name;

        move_uploaded_file($image_tmp, $image_path);

        $stmt = $pdo->prepare("INSERT INTO menu (name, price, image_url) VALUES (?, ?, ?)");
        $stmt->execute([$name, $price, $image_path]);

        header('Location: /coffee_shop/admin/admin.php');
        exit();
    } else {
        $error = "Зураг ачаалахад алдаа гарлаа.";
    }
}

// 🧩 Контентыг эхлүүлж байна
ob_start();
?>

<div class="container mt-5">
  <div class="card shadow p-4">
    <h2 class="mb-4 text-center text-primary">☕️ Шинэ кофе нэмэх</h2>

    <?php if (isset($error)): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="name" class="form-label">Кофены нэр:</label>
        <input type="text" name="name" class="form-control" required placeholder="Жишээ: Latte">
      </div>

      <div class="mb-3">
        <label for="price" class="form-label">Үнэ (₮):</label>
        <input type="number" name="price" class="form-control" required placeholder="Жишээ: 4500">
      </div>

      <div class="mb-4">
        <label for="image" class="form-label">Зураг:</label>
        <input type="file" name="image" class="form-control" required>
      </div>

      <div class="d-flex justify-content-between">
        <a href="/coffee_shop/admin/admin.php" class="btn btn-secondary">← Буцах</a>
        <button type="submit" class="btn btn-primary">Нэмэх</button>
      </div>
    </form>
  </div>
</div>

<?php
$content = ob_get_clean();
include '../layout.php';
?>
