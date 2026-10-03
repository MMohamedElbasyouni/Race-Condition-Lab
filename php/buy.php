<?php
require 'db.php';
$mysqli = get_db();

$price = 10;
$item = "Product";

$res = $mysqli->query("SELECT balance, purchases FROM users WHERE id=1");
$row = $res->fetch_assoc();
$balance = (int) $row['balance'];
$purchases = (int) $row['purchases'];

if ($balance >= $price) {
    usleep(150000);
    $mysqli->query("UPDATE users SET balance = balance - $price, purchases = purchases + 1 WHERE id=1");
    $message = "Purchase successful! You bought: {$item} for \${$price}";
    $sub = "Balance before this purchase: \${$balance}";
} else {
    http_response_code(402);
    $message = "Purchase failed. Insufficient balance.";
    $sub = "Current balance: \${$balance}";
}

$mysqli->close();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<title>Buy</title>
<style>
body {
    font-family: Arial, sans-serif;
    background: #1e1e2e;
    color: #fff;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
    margin: 0;
    text-align: center;
}
.msg {
    font-size: 1.5rem;
    margin-bottom: 10px;
}
.sub {
    font-size: 1rem;
    opacity: 0.8;
    margin-bottom: 20px;
}
a.button {
    background: #4caf50;
    color: #fff;
    padding: 12px 28px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 1.1rem;
}
</style>
</head>
<body>
<div class="msg"><?php echo $message; ?></div>
<div class="sub"><?php echo $sub; ?></div>
<a class="button" href="balance.php">Back to Balance</a>
</body>
</html>
