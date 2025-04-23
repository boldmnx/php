
<!-- signup.php -->
<?php
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
  $role = 'user';
  $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
  $stmt->execute([$username, $password, $role]);
  header('Location: login.php');
}
?>
<form method="post">
  <h2>Signup</h2>
  <input type="text" name="username" required placeholder="Username">
  <input type="password" name="password" required placeholder="Password">
  <button type="submit">Register</button>
</form>
