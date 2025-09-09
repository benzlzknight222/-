<?php
session_start();
require_once '../../src/functions.php';

if (($_SESSION['role'] ?? '') !== 'staff') {
    header('Location: ../login.php');
    exit;
}

$reservation = $_SESSION['reservation'] ?? null;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style.css">
    <title>Staff Dashboard</title>
</head>
<body>
    <h1>Staff Dashboard</h1>
    <?php if ($reservation): ?>
        <p>Current Reservation: Table <?php echo $reservation['table_id']; ?> at <?php echo $reservation['datetime']; ?></p>
    <?php else: ?>
        <p>No current reservations.</p>
    <?php endif; ?>
</body>
</html>
