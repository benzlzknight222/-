<?php
session_start();
require_once '../../src/functions.php';

if (($_SESSION['role'] ?? '') !== 'admin') {
    header('Location: ../login.php');
    exit;
}

$pets = getPets();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <h2>Pet Management</h2>
    <ul>
        <?php foreach ($pets as $pet): ?>
            <li><?php echo htmlspecialchars($pet['name']); ?> - <?php echo $pet['available'] ? 'Available' : 'Unavailable'; ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
