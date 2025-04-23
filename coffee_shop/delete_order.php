<?php
require 'session.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Админ эсвэл зөвшөөрөлтэй хэрэглэгч л устгах эрхтэй
if (!isAdmin()) {
    header("Location: login.php");
    exit();
}

require 'db.php';

// Захиалгын ID-г авах
if (isset($_GET['id'])) {
    $order_id = (int)$_GET['id'];

    // Захиалга байх эсэхийг шалгах
    $stmt = $pdo->prepare("SELECT * FROM orders WHERE id = ?");
    $stmt->execute([$order_id]);
    $order = $stmt->fetch();

    if ($order) {
        // Захиалгыг устгах
        $deleteStmt = $pdo->prepare("DELETE FROM orders WHERE id = ?");
        $deleteStmt->execute([$order_id]);

        header("Location: admin_orders.php"); // Захиалгын жагсаалт руу буцах
        exit();
    } else {
        die("Захиалга олдсонгүй.");
    }
} else {
    die("Захиалгын ID олдсонгүй.");
}
