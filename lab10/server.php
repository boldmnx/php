<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: login.php"); // Redirect to login.php
    exit();
}

include("connect.php");
$email = $_SESSION["email"];
$query = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");
$user = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="mn">
<head>
    <meta charset="UTF-8">
    <title>Нүүр хуудас</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans antialiased">

    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Тавтай морил, <?php echo $user["email"]; ?>!</h2>
            <p class="text-gray-600 mb-6">Сайтад амжилттай нэвтэрсэн байна.</p>
            <a href="server2.php" class="inline-block bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition">Дэлгэрэнгүй</a>
        </div>
    </div>

</body>
</html>
