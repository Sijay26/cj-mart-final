<?php
require 'header.php';
require 'db.php';

$category = $_GET['category'] ?? '';
$stmt = $pdo->prepare("SELECT * FROM products WHERE category = ?");
$stmt->execute([$category]);
$products = $stmt->fetchAll();
?>

<div class="hero" style="padding: 30px;">
    <h1><?php echo htmlspecialchars($category); ?> Collection</h1>
</div>

<div class="products-grid">
    <?php foreach ($products as $product): ?>
    <div class="product-card">
        <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="product-img">
        <div class="product-info">
            <div class="product-name"><?php echo htmlspecialchars($product['name']); ?></div>
            <div class="product-rating">
                <?php
                $rating = $product['rating'];
                for ($i = 0; $i < 5; $i++) {
                    echo ($i < $rating) ? '<i class="fas fa-star"></i>' : '<i class="far fa-star"></i>';
                }
                ?>
                (<?php echo $rating; ?>)
            </div>
            <div class="product-price">₹<?php echo number_format($product['price'], 2); ?></div>
            <p style="font-size: 13px; color: #666; margin-bottom: 10px;"><?php echo htmlspecialchars($product['description']); ?></p>
            
            <div class="btn-group">
                <form action="cart_action.php" method="POST" style="flex: 1;">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <input type="hidden" name="action" value="add">
                    <button type="submit" class="btn btn-sm btn-outline">Add to Cart</button>
                </form>
                <form action="checkout.php" method="POST" style="flex: 1;">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <input type="hidden" name="action" value="buy_now">
                    <button type="submit" class="btn btn-sm">Buy Now</button>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    
    <?php if (count($products) == 0): ?>
        <p style="text-align: center; width: 100%;">No products found in this category.</p>
    <?php endif; ?>
</div>

<?php require 'footer.php'; ?>
