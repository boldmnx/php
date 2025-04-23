<!-- login.php -->
<?php
require 'db.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
  $stmt->execute([$username]);
  $user = $stmt->fetch();
  if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];
    header('Location: index.php');
  } else {
    echo "Invalid credentials.";
  }
}
?>
<!DOCTYPE html>
<html lang="mn">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
  <h2 class="text-center mb-4">Нэвтрэх</h2>

  <form method="post" class="shadow-lg p-4 bg-white rounded">
    <div class="mb-3">
      <label for="username" class="form-label">Нэр:</label>
      <input type="text" name="username" class="form-control" required placeholder="Username">
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Нууц үг:</label>
      <input type="password" name="password" class="form-control" required placeholder="Password">
    </div>

    <button type="submit" class="btn btn-primary w-100">Нэвтрэх</button>
  </form>
</div>

</body>
</html>
