<?php
session_start();
require_once '../../src/functions.php';

$pets = getPets();
$tables = getTables();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $petId = intval($_POST['pet_id'] ?? 0);
    $tableId = intval($_POST['table_id'] ?? 0);
    $datetime = $_POST['datetime'] ?? '';

    if ($petId && !checkPetAvailable($petId)) {
        $error = 'Selected pet is not available.';
    } elseif ($tableId && !checkTableAvailable($tableId, $datetime)) {
        $error = 'Selected table/time not available.';
    } else {
        $data = ['pet_id' => $petId, 'table_id' => $tableId, 'datetime' => $datetime, 'fee' => 50];
        reserve($data);
        header('Location: order.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style.css">
    <title>Book Service</title>
</head>
<body>
    <h1>Book Service</h1>
    <?php if ($error): ?><p style="color:red;"><?php echo htmlspecialchars($error); ?></p><?php endif; ?>
    <form method="post">
        <label>Choose Pet:
            <select name="pet_id">
                <option value="0">No Preference</option>
                <?php foreach ($pets as $p): ?>
                    <option value="<?php echo $p['id']; ?>"><?php echo htmlspecialchars($p['name']); ?></option>
                <?php endforeach; ?>
            </select>
        </label><br>
        <label>Choose Table:
            <select name="table_id">
                <?php foreach ($tables as $t): ?>
                    <option value="<?php echo $t['id']; ?>"><?php echo htmlspecialchars($t['name']); ?></option>
                <?php endforeach; ?>
            </select>
        </label><br>
        <label>Date & Time: <input type="datetime-local" name="datetime" required></label><br>
        <p>Booking fee: 50 THB</p>
        <button type="submit">Book</button>
    </form>
</body>
</html>
