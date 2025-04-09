<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: login.php"); // login.php руу шилжүүлнэ
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Нүүр хуудас</title>
    <script src="https://cdn.tailwindcss.com"></script> <!-- Tailwind нэмэх -->
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-lg rounded-lg p-6 w-96 text-center">
        <h2 class="text-2xl font-semibold text-gray-700">Тавтай морил!</h2>
        <p class="text-gray-500">Таны мэдээлэл:</p>

        <div class="mt-4">
            <p class="text-lg text-gray-800"><strong>Email:</strong> <?php echo htmlspecialchars($user["email"]); ?></p>
        </div>

        <a href="logout.php" class="block bg-red-500 text-white px-4 py-2 rounded mt-4 hover:bg-red-600">
            Гарах
        </a>
    </div>

</body>
</html>
