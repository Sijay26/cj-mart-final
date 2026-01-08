<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CJ Mart - Smart Shopping</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="navbar">
        <a href="index.php" class="brand">
            <img src="cj_mart_logo.png" alt="CJ Mart">
            CJ Mart
        </a>
        <div class="nav-icons">
            <?php if (isset($_SESSION['user_id'])): ?>
                <span style="font-size: 14px; margin-right: 15px; font-weight: 600;">Hi, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <a href="my_orders.php" class="nav-icon" title="My Orders">
                    <i class="fas fa-box"></i>
                </a>
                <a href="cart.php" class="nav-icon" title="Cart">
                    <i class="fas fa-shopping-cart"></i>
                    <?php if ($cart_count > 0): ?>
                        <span class="badge"><?php echo $cart_count; ?></span>
                    <?php endif; ?>
                </a>
                <a href="authenticate.php?action=logout" class="nav-icon" title="Logout">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            <?php else: ?>
                <a href="login.php" class="btn btn-sm" style="width: auto; padding: 5px 15px;">Login</a>
            <?php endif; ?>
        </div>
    </nav>
