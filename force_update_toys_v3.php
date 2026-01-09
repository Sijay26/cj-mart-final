<?php
require 'db.php';

try {
    // 1. Disable Foreign Key Checks
    $pdo->exec("SET FOREIGN_KEY_CHECKS=0");

    // 2. Clear ONLY Toys category
    $stmt = $pdo->prepare("DELETE FROM products WHERE category = 'Toys'");
    $stmt->execute();
    echo "Old 'Toys' products deleted.<br>";

    // 3. New Toys Data with ACCESSIBLE DummyJSON Images
    // We are using images from working categories like 'vehicle', 'womens-bags', 'sunglasses' 
    // to ensure SOMETHING loads, as the specific 'laptops' paths were 404ing.
    $toys = [
        // Using 'vehicle' images for cars
        ['Toys', 'Toy Car', 1299.00, 'Classic model car.', 'https://cdn.dummyjson.com/product-images/vehicle/2.webp', 4.5],
        ['Toys', 'Miniature Car', 299.00, 'Detailed miniature.', 'https://cdn.dummyjson.com/product-images/vehicle/3.webp', 4.3],
        
        // Using 'womens-bags' as generic fillers (better than broken)
        ['Toys', 'Teddy Bear', 899.00, 'Soft cuddly teddy bear.', 'https://cdn.dummyjson.com/product-images/womens-bags/blue-women\'s-handbag/1.webp', 4.7],
        ['Toys', 'Plush Toy', 999.00, 'Soft plush animal.', 'https://cdn.dummyjson.com/product-images/womens-bags/heshe-women\'s-leather-bag/1.webp', 4.4],
        
        // Using 'sunglasses' for small items
        ['Toys', 'Robot Toy', 599.00, 'Futuristic robot toy.', 'https://cdn.dummyjson.com/product-images/sunglasses/black-sunglasses/1.webp', 4.9],
        ['Toys', 'Action Figure', 399.00, 'Hero figure.', 'https://cdn.dummyjson.com/product-images/sunglasses/classic-sunglasses/1.webp', 4.5],
        
        // Using 'furniture'
        ['Toys', 'Building Blocks', 499.00, 'Creative construction set.', 'https://cdn.dummyjson.com/product-images/furniture/bedside-table/1.webp', 4.6],
        ['Toys', 'Kids Kitchen Set', 1599.00, 'Kitchen play set.', 'https://cdn.dummyjson.com/product-images/furniture/sofa/1.webp', 4.8],
        
        // Using 'home-decoration'
        ['Toys', 'Giraffe Toy', 799.00, 'Cute wooden giraffe.', 'https://cdn.dummyjson.com/product-images/home-decoration/plant-pot/1.webp', 4.7],
        ['Toys', 'Wooden Train', 450.00, 'Classic wooden train.', 'https://cdn.dummyjson.com/product-images/home-decoration/decoration-swing/1.webp', 4.2]
    ];

    $sql = "INSERT INTO products (category, name, price, description, image, rating) VALUES (?, ?, ?, ?, ?, ?)";
    $insertStmt = $pdo->prepare($sql);

    foreach ($toys as $item) {
        $insertStmt->execute($item);
    }

    echo "New 'Toys' products inserted with working proxy images.<br>";

    // 4. Re-enable FK checks
    $pdo->exec("SET FOREIGN_KEY_CHECKS=1");

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
