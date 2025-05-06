
<!-- logout.php -->
<?php
session_start();
session_destroy();
header('Location: /coffee_shop/index.php');
?>