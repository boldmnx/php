<?php
$host = "localhost"; 
$user = "root"; 
$password = "mysql"; 
$database = "lab10_db"; 

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Мэдээллийн сантай холбогдож чадсангүй: " . mysqli_connect_error());
}
?>
