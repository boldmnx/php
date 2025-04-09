<?php
session_start();
if (isset($_SESSION["email"])) {
    header("Location: server.php"); 
    exit();
}
include("connect.php"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // SQL injection-ээс хамгаалах
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    $query = mysqli_query($conn, "SELECT * FROM user WHERE email='$email' AND password='$password'");

    if (mysqli_num_rows($query) > 0) {
        $_SESSION["email"] = $email; // Session-д email хадгалах
        header("Location: server.php"); // Амжилттай нэвтэрсэн тохиолдолд дараагийн хуудас руу шилжих
        exit();
    } else {
        echo "<script>alert('Нэвтрэх нэр эсвэл нууц үг буруу байна!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8">
    <title>Нэвтрэх</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-xl max-w-md w-full">
        <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">Нэвтрэх</h2>
        
        <form method="post">
            <div class="mb-4">
                <label for="email" class="block text-gray-700">E-mail хаяг:</label>
                <input type="text" name="email" id="email" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700">Нууц үг:</label>
                <input type="password" name="password" id="password" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <button type="submit" class="w-full py-3 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">Нэвтрэх</button>
        </form>

       
    </div>

</body>
</html>
