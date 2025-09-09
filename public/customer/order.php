<?php
session_start();
require_once '../../src/functions.php';

if (empty($_SESSION['reservation'])) {
    header('Location: book.php');
    exit;
}

$menu = getMenuItems();
$selected = [];
$total = $_SESSION['reservation']['fee'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($menu as $item) {
        $qty = intval($_POST['item_' . $item['id']] ?? 0);
        if ($qty > 0) {
            $selected[] = ['name' => $item['name'], 'qty' => $qty, 'price' => $item['price']];
            $total += $item['price'] * $qty;
        }
    }
    $_SESSION['order'] = $selected;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style.css">
    <title>Order Menu</title>
</head>
<body>
    <h1>Order Menu</h1>
    <?php if (!empty($selected)): ?>
        <h2>Order Summary</h2>
        <ul>
            <?php foreach ($selected as $s): ?>
                <li><?php echo htmlspecialchars($s['name']); ?> x <?php echo $s['qty']; ?></li>
            <?php endforeach; ?>
        </ul>
        <p>Total including booking fee: <?php echo $total; ?> THB</p>
    <?php else: ?>
        <form method="post" id="orderForm">
            <table border="1">
                <tr><th>Item</th><th>Price</th><th>Qty</th></tr>
                <?php foreach ($menu as $m): ?>
                <tr>
                    <td><?php echo htmlspecialchars($m['name']); ?></td>
                    <td><?php echo $m['price']; ?></td>
                    <td><input type="number" name="item_<?php echo $m['id']; ?>" data-price="<?php echo $m['price']; ?>" min="0" value="0"></td>
                </tr>
                <?php endforeach; ?>
            </table>
            <p id="total">Total including booking fee: <?php echo $total; ?> THB</p>
            <button type="submit">Submit Order</button>
        </form>
        <script>
        document.querySelectorAll('input[type=number]').forEach(function(input){
            input.addEventListener('input', function(){
                let total = <?php echo $_SESSION['reservation']['fee']; ?>;
                document.querySelectorAll('input[type=number]').forEach(function(i){
                    const price = parseInt(i.dataset.price);
                    const qty = parseInt(i.value || 0);
                    total += price * qty;
                });
                document.getElementById('total').textContent = 'Total including booking fee: ' + total + ' THB';
            });
        });
        </script>
    <?php endif; ?>
</body>
</html>
