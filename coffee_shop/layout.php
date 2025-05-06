<?php
require_once 'db/session.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "Зочин";
?>


<!DOCTYPE html>
<html lang="mn">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light">

    <header class="bg-dark text-white py-3 mb-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h4 mb-0">Сайн уу, <?= htmlspecialchars($username) ?>!</h1>
            <nav>
                <a href="/coffee_shop/index.php" class="btn btn-outline-light btn-sm me-2">Home</a>
                <a href="/coffee_shop/menu/menu.php" class="btn btn-outline-light btn-sm me-2">Menu</a>
                <?php if (isLoggedIn()) : ?>
                    <?php if (isAdmin()) : ?>
                        <a href="/coffee_shop/admin/admin.php" class="btn btn-warning btn-sm">Admin</a>
                    <?php endif; ?>
                    <a href="/coffee_shop/auth/logout.php" class="btn btn-danger btn-sm me-2">Logout</a>
                <?php else : ?>
                    <a href="/coffee_shop/auth/signup.php" class="btn btn-success btn-sm me-2">Sign Up</a>
                    <a href="/coffee_shop/auth/login.php" class="btn btn-primary btn-sm me-2">Login</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>
    <main class="container my-5">
        <?= $content ?>
    </main>
    <footer class="bg-light text-center py-4 mt-5">
        <div class="container">
            <p class="mb-0">&copy; 2025 Coffee Shop. Made by Daaluu and Yoz</p>
        </div>
    </footer>
</body>

</html>