<?php
require_once __DIR__ . '/db.php';
$tables = getTables();
$menu = [
    ['id' => 1, 'name' => 'ลาเต้', 'price' => 60],
    ['id' => 2, 'name' => 'เค้กช็อกโกแลต', 'price' => 80],
    ['id' => 3, 'name' => 'น้ำเปล่า', 'price' => 20],
];
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tableId = (int)$_POST['table_id'];
    $items = $_POST['items'] ?? [];
    // ในระบบจริงควรบันทึกลงฐานข้อมูลพร้อมเวลาที่เริ่ม
    $message = 'สั่งอาหารเรียบร้อย';
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>สั่งอาหาร</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<h1>สั่งอาหาร/เครื่องดื่ม</h1>
<?php if ($message): ?>
    <p class="success"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>
<form method="post">
    <label>เลือกโต๊ะ:
        <select name="table_id" required>
            <?php foreach ($tables as $table): ?>
                <option value="<?= $table['id'] ?>"><?= htmlspecialchars($table['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    <fieldset>
        <legend>เมนู</legend>
        <?php foreach ($menu as $item): ?>
            <label>
                <input type="checkbox" name="items[]" value="<?= $item['id'] ?>">
                <?= htmlspecialchars($item['name']) ?> (<?= $item['price'] ?> บาท)
            </label><br>
        <?php endforeach; ?>
    </fieldset>
    <button type="submit">ยืนยันการสั่ง</button>
</form>
</body>
</html>
