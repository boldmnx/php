
<!-- db.php -->
<?php
$host = 'localhost';
$db = 'coffee_shop';
$user = 'root';
$pass = 'mysql';
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];
try {
  $pdo = new PDO($dsn, $user, $pass, $options);
} catch (Exception $e) {
  die("DB Connection Error: " . $e->getMessage());
}
?>