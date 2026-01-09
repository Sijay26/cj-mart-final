<?php
require 'db.php';

try {
    // 1. Disable FK checks
    $pdo->exec("SET FOREIGN_KEY_CHECKS=0");

    // 2. Clear old categories (Dresses, Toys, Skincare)
    $stmt = $pdo->prepare("DELETE FROM products WHERE category IN ('Dresses', 'Toys', 'Skincare')");
    $stmt->execute();
    echo "Old 'Dresses', 'Toys', 'Skincare' products deleted.<br>";

    // 3. New Data Lists
    $dresses = [
        ['Dresses', 'Classic White Shirt', 899.00, 'Formal women\'s button-up shirt.', 'https://images.unsplash.com/photo-1598532163257-ae3c6b2524b6?auto=format&fit=crop&w=400&q=80', 4.5],
        ['Dresses', 'Blue Denim Jeans', 1299.00, 'Classic blue denim jeans.', 'https://images.unsplash.com/photo-1542272617-08f08630329e?auto=format&fit=crop&w=400&q=80', 4.6],
        ['Dresses', 'Traditional Kurti', 1499.00, 'Elegant ethnic wear kurti.', 'https://images.unsplash.com/photo-kN3tHdXDDrs?auto=format&fit=crop&w=400&q=80', 4.7],
        ['Dresses', 'Salwar Kameez Set', 1899.00, 'Complete chudidhar set.', 'https://images.unsplash.com/photo-uC8ddgW26nU?auto=format&fit=crop&w=400&q=80', 4.8],
        ['Dresses', 'Silk Saree', 2999.00, 'Traditional Indian silk saree.', 'https://images.unsplash.com/photo-FKnT2BszwLA?auto=format&fit=crop&w=400&q=80', 4.9],
        ['Dresses', 'Casual T-Shirt', 499.00, 'Comfortable daily wear.', 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=400&q=80', 4.3],
        ['Dresses', 'Denim Shorts', 699.00, 'Stylish summer shorts.', 'https://images.unsplash.com/photo-1591195853828-11db59a44f6b?auto=format&fit=crop&w=400&q=80', 4.4],
        ['Dresses', 'Black Velvet Dress', 1599.00, 'Evening elegance.', 'https://images.unsplash.com/photo-1572804013309-59eb88591953?auto=format&fit=crop&w=400&q=80', 4.8],
        ['Dresses', 'Leather Skirt', 1999.00, 'Chic black leather skirt.', 'https://images.unsplash.com/photo-49PDkKNPYbc?auto=format&fit=crop&w=400&q=80', 4.5],
        ['Dresses', 'Designer Summer Dress', 4999.00, 'Exclusive summer design.', 'https://images.unsplash.com/photo-1515372039744-b8f02a3ae446?auto=format&fit=crop&w=400&q=80', 4.9]
    ];

    $toys = [
        ['Toys', 'Teddy Bear', 899.00, 'Soft cuddly teddy bear.', 'https://images.unsplash.com/photo-4wJxVFbZr1c?auto=format&fit=crop&w=400&q=80', 4.7],
        ['Toys', 'Robot Toy', 599.00, 'Futuristic robot toy.', 'https://images.unsplash.com/photo-ZgS2jHjO8i0?auto=format&fit=crop&w=400&q=80', 4.9],
        ['Toys', 'Toy Car', 1299.00, 'Classic model car.', 'https://images.unsplash.com/photo-1594787318286-3d835c1d207f?auto=format&fit=crop&w=400&q=80', 4.5],
        ['Toys', 'Building Blocks', 499.00, 'Creative construction set.', 'https://images.unsplash.com/photo-p-7TtH69twY?auto=format&fit=crop&w=400&q=80', 4.6],
        ['Toys', 'Miniature Car', 299.00, 'Detailed miniature.', 'https://images.unsplash.com/photo-k0sw636XC30?auto=format&fit=crop&w=400&q=80', 4.3],
        ['Toys', 'Plush Toy', 999.00, 'Soft plush animal.', 'https://images.unsplash.com/photo-1555445054-d96531916919?auto=format&fit=crop&w=400&q=80', 4.4],
        ['Toys', 'Action Figure', 399.00, 'Hero figure.', 'https://images.unsplash.com/photo-7aMHW4L5dXc?auto=format&fit=crop&w=400&q=80', 4.5],
        ['Toys', 'Kids Kitchen Set', 1599.00, 'Kitchen play set.', 'https://images.unsplash.com/photo-TIBKlzb6u9k?auto=format&fit=crop&w=400&q=80', 4.8],
        ['Toys', 'Giraffe Toy', 799.00, 'Cute wooden giraffe.', 'https://images.unsplash.com/photo-1548247661-3d790594093e?auto=format&fit=crop&w=400&q=80', 4.7],
        ['Toys', 'Wooden Train', 450.00, 'Classic wooden train.', 'https://images.unsplash.com/photo-uE2XxvHN6Tk?auto=format&fit=crop&w=400&q=80', 4.2]
    ];

    $skincare = [
        ['Skincare', 'Attitude Hand Soap', 150.00, 'Natural nourishing soap.', 'https://cdn.dummyjson.com/product-images/skin-care/attitude-super-leaves-hand-soap/1.webp', 4.5],
        ['Skincare', 'Olay Body Wash', 299.00, 'Moisturizing body wash.', 'https://cdn.dummyjson.com/product-images/skin-care/olay-ultra-moisture-shea-butter-body-wash/1.webp', 4.6],
        ['Skincare', 'Vaseline Lotion', 450.00, 'Deep moisture lotion.', 'https://cdn.dummyjson.com/product-images/skin-care/vaseline-men-body-and-face-lotion/1.webp', 4.8],
        ['Skincare', 'Luxury Serum', 599.00, 'Vitamin C serum.', 'https://images.unsplash.com/photo-qVyNNbfAGO4?auto=format&fit=crop&w=400&q=80', 4.9],
        ['Skincare', 'Night Cream', 699.00, 'Rejuvenating night cream.', 'https://images.unsplash.com/photo-5aUCj0qUbHY?auto=format&fit=crop&w=400&q=80', 4.7],
        ['Skincare', 'Hydrating Mask', 99.00, 'Aloe vera sheet mask.', 'https://images.unsplash.com/photo-bNkbVfAfzd0?auto=format&fit=crop&w=400&q=80', 4.4],
        ['Skincare', 'Body Lotion', 350.00, 'Cocoa butter lotion.', 'https://images.unsplash.com/photo-1608248597279-f99d160bfbc8?auto=format&fit=crop&w=400&q=80', 4.5],
        ['Skincare', 'Toner', 250.00, 'Rose water toner.', 'https://images.unsplash.com/photo-Ei1pWYtpReA?auto=format&fit=crop&w=400&q=80', 4.3],
        ['Skincare', 'Cleanser', 199.00, 'Foaming face wash.', 'https://images.unsplash.com/photo-ppk8KD_CS-w?auto=format&fit=crop&w=400&q=80', 4.4],
        ['Skincare', 'Herbal Cream', 120.00, 'Ayurvedic skin cream.', 'https://images.unsplash.com/photo-4BhkXTpQwaQ?auto=format&fit=crop&w=400&q=80', 4.2]
    ];

    $sql = "INSERT INTO products (category, name, price, description, image, rating) VALUES (?, ?, ?, ?, ?, ?)";
    $insertStmt = $pdo->prepare($sql);

    foreach (array_merge($dresses, $toys, $skincare) as $item) {
        $insertStmt->execute($item);
    }

    echo "New 'Dresses', 'Toys', 'Skincare' products inserted successfully.<br>";

    // 4. Re-enable FK checks
    $pdo->exec("SET FOREIGN_KEY_CHECKS=1");
    echo "Update Complete.";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
