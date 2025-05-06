<!-- signup.php -->
<?php
require '../db/db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if ($_POST['rePassword'] !== $_POST['password']) {
    $_SESSION['error'] = "Нууц үг таарахгүй байна!";
    header('Location: /coffee_shop/auth/signup.php');
    exit();
  }

  $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
  $stmt->execute([$username]);
  $existingUserCount = $stmt->fetchColumn();

  if ($existingUserCount > 0) {
    $_SESSION['error'] = "Энэ хэрэглэгчийн нэр аль хэдийн хэрэглэгдэж байна!";
    header('Location: /coffee_shop/auth/signup.php');
    exit();
  }
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
  $role = 'user';
  $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
  $stmt->execute([$username, $password, $role]);
  header('Location: /coffee_shop/auth/login.php');
}
?>
<form method="post" class="shadow-lg p-4 bg-white rounded">
  <h2 class="text-center mb-4">Бүргүүлэх</h2>

  <label for="username" class="form-label">Нэр:</label>
  <input class="form-control" type="text" name="username" required placeholder="Username">

  <label for="password" class="form-label">Password:</label>
  <input class="form-control" type="password" name="password" required placeholder="Password">

  <label for="rePassword" class="form-label">rePassword:</label>
  <input class="form-control" type="password" name="rePassword" required placeholder="rePassword"><br />
  <button class="btn btn-primary w-100" type="submit">Register</button>
</form>

<?php $content = ob_get_clean();
include '../layout.php';
