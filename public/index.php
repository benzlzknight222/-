<?php
require_once __DIR__ . '/db.php';
$animals = getAvailableAnimals();
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>French Oni Cafe</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>ยินดีต้อนรับสู่ร้านเฟรนช์ โอนิ</h1>
    <nav>
        <a href="booking.php">จองบริการ</a> |
        <a href="order.php">สั่งอาหาร</a>
    </nav>
    <h2>สัตว์เลี้ยงที่พร้อมให้บริการ</h2>
    <ul>
        <?php foreach ($animals as $animal): ?>
            <li><?= htmlspecialchars($animal['name']) ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
