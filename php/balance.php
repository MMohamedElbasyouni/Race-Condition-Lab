<?php
require 'db.php';
$mysqli = get_db();

if (isset($_GET['reset'])) {
    $mysqli->query("UPDATE users SET balance = 100, purchases = 0 WHERE id=1");
}

$res = $mysqli->query("SELECT balance, purchases FROM users WHERE id=1");
$row = $res->fetch_assoc();
$balance = $row['balance'];
$purchases = $row['purchases'];

$mysqli->close();
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<title>Current Balance</title>
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
}
.balance {
    font-size: 2rem;
    margin-bottom: 8px;
}
.purchases {
    font-size: 1.1rem;
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
    margin: 6px;
}
a.reset {
    background: #555;
}
</style>
</head>
<body>
<div class="balance">Current Balance: $<?php echo $balance; ?></div>
<div class="purchases">Items purchased: <?php echo $purchases; ?></div>
<a class="button" href="buy.php">Buy the Product</a>
<a class="button reset" href="balance.php?reset=1">Reset</a>
</body>
</html>
