<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $role = $_POST['role'] ?? 'customer';
    $_SESSION['role'] = $role;
    $_SESSION['username'] = $_POST['username'] ?? 'guest';

    if ($role === 'admin') {
        header('Location: admin/dashboard.php');
    } elseif ($role === 'staff') {
        header('Location: staff/dashboard.php');
    } else {
        header('Location: customer/book.php');
    }
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="post">
        <label>Username: <input type="text" name="username"></label><br>
        <label>Role:
            <select name="role">
                <option value="customer">Customer</option>
                <option value="admin">Admin</option>
                <option value="staff">Staff</option>
            </select>
        </label><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
