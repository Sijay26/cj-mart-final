<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$address = $_POST['address'];
$mobile = $_POST['mobile']; // We might want to save this if we had a shipping table, but here sticking to schema
// Schema for orders: id, user_id, product_id, address, order_date, status.
// It doesn't have mobile, so we include mobile in address for now or ignore.
$full_address = $_POST['name'] . ", " . $mobile . ", " . $address;

$source = $_POST['source'];

try {
    $pdo->beginTransaction();

    if ($source === 'buy_now') {
        $product_id = $_POST['product_id'];
        $stmt = $pdo->prepare("INSERT INTO orders (user_id, product_id, address, status) VALUES (?, ?, ?, 'Placed')");
        $stmt->execute([$user_id, $product_id, $full_address]);
    } else {
        // Cart checkout
        if (!empty($_SESSION['cart'])) {
            $ids = array_keys($_SESSION['cart']); 
            if(count($ids) > 0) {
                 // For each item in cart, insert a row. 
                 // If qty > 1, insert multiple rows or just 1 row? 
                 // Schema is simple. Let's insert 1 row per unit quantity to be precise with "id" tracking, or 1 row per product type.
                 // Given user schema limitations, I'll insert 1 row per product type found in cart, repeating for quantity is excessive for simple DB.
                 // Actually, let's just loop.
                 foreach ($_SESSION['cart'] as $pid => $qty) {
                     for ($i=0; $i < $qty; $i++) {
                         $stmt = $pdo->prepare("INSERT INTO orders (user_id, product_id, address, status) VALUES (?, ?, ?, 'Placed')");
                         $stmt->execute([$user_id, $pid, $full_address]);
                     }
                 }
                 // Clear cart
                 unset($_SESSION['cart']);
                 $pdo->prepare("DELETE FROM cart WHERE user_id = ?")->execute([$user_id]);
            }
        }
    }

    $pdo->commit();
    
    // Success Page
    echo '<!DOCTYPE html>
    <html>
    <head>
        <title>Order Placed</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div style="min-height: 100vh; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; background: var(--bg-gradient);">
            <div style="background: white; padding: 50px; border-radius: 20px; box-shadow: var(--shadow);">
                <div style="color: #28a745; font-size: 60px; margin-bottom: 20px;">✔</div>
                <h1 style="color: var(--primary-color);">Order Placed Successfully!</h1>
                <p>Thank you for shopping with CJ Mart.</p>
                <a href="index.php" class="btn" style="margin-top: 30px;">Continue Shopping</a>
                <br>
                <a href="my_orders.php" class="link" style="margin-top: 20px; display: inline-block;">View My Orders</a>
            </div>
        </div>
    </body>
    </html>';

} catch (Exception $e) {
    $pdo->rollBack();
    echo "Order Failed: " . $e->getMessage();
}
?>
