<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8">
    <title>Хэрэглэгчийн мэдээлэл</title>
    <style>
        .username { color: dark; font-weight: bold; }
        .email { color: dark; font-weight: bold; }
    </style>
</head>
<body>

<a href="http://localhost/osan/lab6/post_method.php">got to postMethod</a><br>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required><br><br>

        <button type="submit">Нэвтрэх</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['username']) && isset($_GET['email'])) {
        $username = htmlspecialchars($_GET['username']);
        $email = htmlspecialchars($_GET['email']);

        echo "<p>Таны хэрэглэгчийн нэр нь <span class='username'>$username</span> байна.</p>";
        echo "<p>Таны Email хаяг <span class='email'>$email</span> байна.</p>";
    }
    ?>

</body>
</html>
