<?php

require_once '../db/db.php';
require_once '../db/session.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Админ эсвэл зөвшөөрөлтэй хэрэглэгч л устгах эрхтэй
if (!isAdmin()) {
    header("Location: /coffee_shop/auth/login.php");
    exit();
}


// Захиалгын ID-г авах
if (isset($_GET['id'])) {
    $order_id = (int)$_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM orders WHERE id = ?");
    $stmt->execute([$order_id]);
    $order = $stmt->fetch();

    if ($order) {
        $deleteStmt = $pdo->prepare("DELETE FROM orders WHERE id = ?");
        $deleteStmt->execute([$order_id]);

        header("Location: /coffee_shop/admin/admin_orders.php"); 
        exit();
    } else {
        die("Захиалга олдсонгүй.");
    }
} else {
    die("Захиалгын ID олдсонгүй.");
}
