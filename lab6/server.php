<?php
$username = $_POST['username'] ?? '';
$pass = $_POST['pass'] ?? '';
?>
<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8">
    <title>Өгөгдлийг харуулах</title>
    <style>
        body { background-color: #f4f4f4; font-family: Arial; }
        .container { width: 1000px; height: 1100px; margin: 0 auto; background: #f0f0f0; padding: 20px; }
    </style>
</head>
<body>
    <a href="http://localhost/osan/lab6/login.php">got to login</a>
    <div class="container">
        <h1>Таны мэдээлэл</h1>
        <p>Хэрэглэгчийн нэр: <?php echo htmlspecialchars($username); ?></p>
        <p>Нууц үг: <?php echo htmlspecialchars($pass); ?></p>
    </div>
</body>
</html>
