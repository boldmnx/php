<?php
require_once '../db/db.php';
require '../db/session.php';
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
if (!isAdmin()) {
  header('Location: /coffee_shop/index.php');
  exit();
}

if (isset($_GET['id'])) {
  $coffee_id = $_GET['id'];

  $deleteStmt = $pdo->prepare("DELETE FROM menu WHERE id = :id");
  $deleteStmt->bindValue(':id', $coffee_id, PDO::PARAM_INT);
  $deleteStmt->execute();

  header('Location: /coffee_shop/admin/admin.php');
  exit();
}
?>
