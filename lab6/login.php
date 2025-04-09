<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8">
    <title>Нэвтрэх</title>
    <style>
        body { background-color: #f4f4f4; font-family: Arial; }
        .container { width: 1000px; height: 1100px; margin: 0 auto; background: #f0f0f0; padding: 20px; }
        input { margin: 10px; }
    </style>
</head>
<body>
<a href="http://localhost/osan/lab6/server.php">got to server</a><br>
<a href="http://localhost/osan/lab6/color.php">got to color form</a>


    <div class="container">
        <h1>Нэвтрэх</h1>
        <form action="server.php" method="post">
            <input type="text" name="username" placeholder="Хэрэглэгчийн нэр"><br>
            <input type="password" name="pass" placeholder="Нууц үг"><br>
            <input type="submit" value="Нэвтрэх">
        </form>
    </div>
</body>
</html>
