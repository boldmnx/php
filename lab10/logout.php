<?php
session_start();
session_destroy(); // Session устгах
header("Location: login.php"); // Нэвтрэх хуудас руу буцаах
exit();
?>