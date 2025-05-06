<?php
require '../db/db.php';
session_start();
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $menu_id = (int) $_POST['menu_id'];
    $quantity = (int) $_POST['quantity'];

    // Бүтээгдэхүүний үнийг авч байна
    $stmt = $pdo->prepare("SELECT price FROM menu WHERE id = ?");
    $stmt->execute([$menu_id]);
    $item = $stmt->fetch();

    if ($item) {
        $price = $item['price'];
        $total = $price * $quantity;

        // Захиалгыг хадгална
        $stmt = $pdo->prepare("INSERT INTO orders (menu_id, quantity, total_price,user_id) VALUES (?, ?, ?,?)");
        $stmt->execute([$menu_id, $quantity, $total, $user_id]);

        header("Location: /coffee_shop/menu/menu.php?order=success");
        exit();
    }
}
