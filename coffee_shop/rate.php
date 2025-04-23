<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $menu_id = (int) $_POST['menu_id'];
    $rating = (int) $_POST['rating'];

    // Үнэлгээг хадгална
    $stmt = $pdo->prepare("INSERT INTO ratings (menu_id, rating) VALUES (?, ?)");
    $stmt->execute([$menu_id, $rating]);

    // Дундажийг дахин тооцоолно
    $stmt = $pdo->prepare("SELECT AVG(rating) FROM ratings WHERE menu_id = ?");
    $stmt->execute([$menu_id]);
    $avg = $stmt->fetchColumn();

    // menu хүснэгтэд хадгална
    $stmt = $pdo->prepare("UPDATE menu SET average_rating = ? WHERE id = ?");
    $stmt->execute([$avg, $menu_id]);

    header("Location: menu.php");
    exit();
}
