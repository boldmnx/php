<?php
require 'db.php';
require 'session.php';

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (!isAdmin()) {
  header('Location: index.php');
  exit();
}

if (isset($_GET['id'])) {
  $user_id = (int)$_GET['id'];

  // Хэрэглэгчийг устгах
  $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
  $stmt->execute([$user_id]);

  header('Location: admin.php'); // Админ панел руу шилжих
  exit();
} else {
  die("Хэрэглэгчийн ID олдсонгүй.");
}
?>
