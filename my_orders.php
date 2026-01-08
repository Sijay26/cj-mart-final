<?php
require 'header.php';
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
// Join with products to get details
$stmt = $pdo->prepare("SELECT o.*, p.name, p.image, p.price FROM orders o JOIN products p ON o.product_id = p.id WHERE o.user_id = ? ORDER BY o.order_date DESC");
$stmt->execute([$user_id]);
$orders = $stmt->fetchAll();
?>

<div class="hero" style="padding: 30px;">
    <h1>My Orders</h1>
</div>

<div style="max-width: 800px; margin: 0 auto; padding: 20px;">
    <?php if (count($orders) == 0): ?>
        <p style="text-align: center;">You haven't placed any orders yet.</p>
    <?php else: ?>
        <?php foreach ($orders as $order): ?>
        <div style="background: white; padding: 20px; border-radius: 15px; box-shadow: var(--shadow); display: flex; gap: 20px; margin-bottom: 20px; align-items: center;">
            <img src="<?php echo htmlspecialchars($order['image']); ?>" style="width: 80px; height: 80px; object-fit: cover; border-radius: 10px;">
            <div style="flex-grow: 1;">
                <h3 style="margin: 0 0 5px;"><?php echo htmlspecialchars($order['name']); ?></h3>
                <p style="font-size: 14px; color: #666; margin-bottom: 5px;">Price: ₹<?php echo number_format($order['price'], 2); ?></p>
                <p style="font-size: 12px; color: #999;">Ordered on: <?php echo date('d M Y, h:i A', strtotime($order['order_date'])); ?></p>
                <p style="font-size: 12px; color: #555;">Address: <?php echo htmlspecialchars($order['address']); ?></p>
            </div>
            <div style="text-align: right;">
                <span style="background: #e6fcf5; color: #0ca678; padding: 5px 10px; border-radius: 15px; font-size: 12px; font-weight: bold;">
                    <?php echo htmlspecialchars($order['status']); ?>
                </span>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php require 'footer.php'; ?>
