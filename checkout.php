<?php
require 'header.php';
require 'db.php';

// Check login
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please login to continue'); window.location='login.php';</script>";
    exit;
}

$action = $_POST['action'] ?? 'cart_checkout';
$product_id = $_POST['product_id'] ?? null;
$items_to_buy = [];
$total_amount = 0;

if ($action === 'buy_now' && $product_id) {
    // Fetch single product
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch();
    if ($product) {
        $product['qty'] = 1;
        $product['subtotal'] = $product['price'];
        $items_to_buy[] = $product;
        $total_amount = $product['price'];
    }
} else {
    // Checkout from cart
    if (!empty($_SESSION['cart'])) {
        $ids = array_keys($_SESSION['cart']); 
        if(count($ids) > 0) {
            $placeholders = str_repeat('?,', count($ids) - 1) . '?';
            $stmt = $pdo->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
            $stmt->execute($ids);
            $products = $stmt->fetchAll();
            
            foreach ($products as $p) {
                $p['qty'] = $_SESSION['cart'][$p['id']];
                $p['subtotal'] = $p['price'] * $p['qty'];
                $items_to_buy[] = $p;
                $total_amount += $p['subtotal'];
            }
        }
    }
}

if (empty($items_to_buy)) {
    echo "<p class='container'>No items to checkout.</p>";
    require 'footer.php';
    exit;
}
?>

<div class="hero" style="padding: 30px;">
    <h1>Checkout</h1>
</div>

<div class="container" style="display: flex; gap: 40px; justify-content: center; flex-wrap: wrap;">
    <!-- Order Summary -->
    <div style="flex: 1; min-width: 300px; max-width: 500px; background: white; padding: 20px; border-radius: 15px; box-shadow: var(--shadow); align-self: flex-start;">
        <h3 style="margin-bottom: 20px;">Order Summary</h3>
        <?php foreach ($items_to_buy as $item): ?>
        <div style="display: flex; justify-content: space-between; margin-bottom: 10px; border-bottom: 1px solid #f0f0f0; padding-bottom: 10px;">
            <span><?php echo htmlspecialchars($item['name']); ?> x <?php echo $item['qty']; ?></span>
            <span>₹<?php echo number_format($item['subtotal'], 2); ?></span>
        </div>
        <?php endforeach; ?>
        <div style="display: flex; justify-content: space-between; font-weight: bold; font-size: 18px; margin-top: 20px;">
            <span>Total Payable</span>
            <span style="color: var(--primary-color);">₹<?php echo number_format($total_amount, 2); ?></span>
        </div>
    </div>

    <!-- Shipping Details -->
    <div style="flex: 1; min-width: 300px; max-width: 500px; background: white; padding: 20px; border-radius: 15px; box-shadow: var(--shadow);">
        <h3 style="margin-bottom: 20px;">Shipping Details</h3>
        <form action="place_order.php" method="POST">
            <input type="hidden" name="source" value="<?php echo ($action === 'buy_now') ? 'buy_now' : 'cart'; ?>">
            <?php if ($action === 'buy_now'): ?>
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            <?php endif; ?>
            
            <div class="form-group">
                <label>Receiver Name</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($_SESSION['username']); ?>" required>
            </div>
            <div class="form-group">
                <label>Mobile Number</label>
                <input type="tel" name="mobile" pattern="[0-9]{10}" placeholder="For delivery contact" required>
            </div>
            <div class="form-group">
                <label>Full Address</label>
                <textarea name="address" rows="4" style="width: 100%; padding: 10px; border: 2px solid #ddd; border-radius: 10px;" required></textarea>
            </div>
            
            <button type="submit" class="btn" style="margin-top: 20px;">Place Order</button>
        </form>
    </div>
</div>

<?php require 'footer.php'; ?>
