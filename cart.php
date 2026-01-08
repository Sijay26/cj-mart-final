<?php
require 'header.php';
require 'db.php';

$cart = $_SESSION['cart'] ?? [];
$cartItems = [];
$total = 0;

if (!empty($cart)) {
    // Fetch product details
    $ids = implode(',', array_keys($cart));
    // Sanitize IDs logic skipped for brevity, but array_keys gives ints usually.
    // Better way:
    $placeholders = str_repeat('?,', count($cart) - 1) . '?';
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
    $stmt->execute(array_keys($cart));
    $products = $stmt->fetchAll();
    
    foreach ($products as $p) {
        $p['qty'] = $cart[$p['id']];
        $p['subtotal'] = $p['price'] * $p['qty'];
        $total += $p['subtotal'];
        $cartItems[] = $p;
    }
}
?>

<div class="hero" style="padding: 30px;">
    <h1>Your Cart</h1>
</div>

<div style="max-width: 800px; margin: 0 auto; padding: 20px;">
    <?php if (empty($cartItems)): ?>
        <p style="text-align: center;">Your cart is empty. <a href="index.php" class="link">Start Shopping</a></p>
    <?php else: ?>
        <div style="background: white; padding: 20px; border-radius: 15px; box-shadow: var(--shadow);">
            <?php foreach ($cartItems as $item): ?>
            <div style="display: flex; gap: 20px; border-bottom: 1px solid #eee; padding-bottom: 20px; margin-bottom: 20px;">
                <img src="<?php echo htmlspecialchars($item['image']); ?>" style="width: 80px; height: 80px; object-fit: cover; border-radius: 10px;">
                <div style="flex-grow: 1;">
                    <h3 style="margin: 0 0 5px;"><?php echo htmlspecialchars($item['name']); ?></h3>
                    <p style="color: var(--primary-color); font-weight: bold;">₹<?php echo number_format($item['price'], 2); ?></p>
                </div>
                <div style="text-align: right;">
                    <form action="cart_action.php" method="POST">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                        <input type="number" name="quantity" value="<?php echo $item['qty']; ?>" min="1" style="width: 50px; padding: 5px; border-radius: 5px; border: 1px solid #ddd;" onchange="this.form.submit()">
                    </form>
                    <div style="margin-top: 10px; font-weight: bold;">₹<?php echo number_format($item['subtotal'], 2); ?></div>
                    <form action="cart_action.php" method="POST" style="margin-top: 5px;">
                        <input type="hidden" name="action" value="remove">
                        <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                        <button type="submit" style="background: none; border: none; color: red; cursor: pointer; font-size: 12px;">Remove</button>
                    </form>
                </div>
            </div>
            <?php endforeach; ?>
            
            <div style="text-align: right; font-size: 20px; margin-top: 20px;">
                Total: <strong>₹<?php echo number_format($total, 2); ?></strong>
            </div>
            
            <div style="margin-top: 30px; text-align: right;">
                <form action="checkout.php" method="post">
                    <button type="submit" class="btn" style="width: auto; display: inline-block; padding: 15px 40px;">Proceed to Checkout</button>
                </form>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php require 'footer.php'; ?>
