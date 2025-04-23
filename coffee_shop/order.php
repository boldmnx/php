<?php
require 'db.php';

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
        $stmt = $pdo->prepare("INSERT INTO orders (menu_id, quantity, total_price) VALUES (?, ?, ?)");
        $stmt->execute([$menu_id, $quantity, $total]);

        header("Location: menu.php?order=success");
        exit();
    }
}
