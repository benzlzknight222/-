<?php
require_once __DIR__ . '/db.php';
$animals = getAvailableAnimals();
$tables = getTables();
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $animalId = !empty($_POST['animal_id']) ? (int)$_POST['animal_id'] : null;
    $tableId = (int)$_POST['table_id'];
    $datetime = $_POST['datetime'];

    if ($animalId && !isAnimalAvailable($animalId)) {
        $message = 'สัตว์ไม่พร้อมบริการ';
    } elseif (!isTableAvailable($tableId, $datetime)) {
        $message = 'โต๊ะไม่ว่าง กรุณาเลือกโต๊ะใหม่';
    } else {
        saveBooking([
            'animal_id' => $animalId,
            'table_id' => $tableId,
            'datetime' => $datetime,
            'fee' => 50,
        ]);
        header('Location: order.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>จองบริการ</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<h1>จองบริการ</h1>
<?php if ($message): ?>
    <p class="error"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>
<form method="post">
    <label>เลือกสัตว์เลี้ยง (ไม่จำเป็น):
        <select name="animal_id">
            <option value="">ไม่เลือกสัตว์</option>
            <?php foreach ($animals as $animal): ?>
                <option value="<?= $animal['id'] ?>"><?= htmlspecialchars($animal['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    <label>เลือกโต๊ะ:
        <select name="table_id" required>
            <?php foreach ($tables as $table): ?>
                <option value="<?= $table['id'] ?>"><?= htmlspecialchars($table['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    <label>วันและเวลา:
        <input type="datetime-local" name="datetime" required>
    </label>
    <button type="submit">ยืนยันการจอง (ค่าธรรมเนียม 50 บาท)</button>
</form>
</body>
</html>
