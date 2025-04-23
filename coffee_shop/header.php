<?php
require_once 'session.php';
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "Зочин";
?>

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<header class="bg-dark text-white py-3 mb-4">
  <div class="container d-flex justify-content-between align-items-center">
    <h1 class="h4 mb-0">Сайн уу, <?= htmlspecialchars($username) ?>!</h1>
    <nav>
      <a href="index.php" class="btn btn-outline-light btn-sm me-2">Home</a>
      <?php if (isAdmin()) : ?>
        <a href="menu.php" class="btn btn-outline-light btn-sm me-2">Menu</a>
      <?php endif; ?>
      <?php if (!isLoggedIn()) : ?>
        <a href="signup.php" class="btn btn-success btn-sm me-2">Sign Up</a>
        <a href="login.php" class="btn btn-primary btn-sm me-2">Login</a>
      <?php else : ?>
        <a href="logout.php" class="btn btn-danger btn-sm me-2">Logout</a>
        <?php if (isAdmin()) : ?>
          <a href="admin.php" class="btn btn-warning btn-sm">Admin</a>
        <?php endif; ?>
      <?php endif; ?>
    </nav>
  </div>
</header>