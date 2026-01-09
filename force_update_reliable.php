<?php
require 'db.php';

try {
    // 1. Disable Foreign Key Checks
    $pdo->exec("SET FOREIGN_KEY_CHECKS=0");

    // 2. Clear categories
    $stmt = $pdo->prepare("DELETE FROM products WHERE category IN ('Dresses', 'Toys', 'Skincare', 'Grocery', 'Mobiles')");
    $stmt->execute();
    echo "Old products cleared.<br>";

    // 3. Insert Reliable DummyJSON Data
    // Using verified working URLs from dummyjson.com
    $sql = "INSERT INTO products (category, name, price, description, image, rating) VALUES
    
    -- DRESSES (Using Tops/Dresses images that are known to work)
    ('Dresses', 'Classic White Shirt', 899.00, 'Formal women\'s button-up shirt.', 'https://cdn.dummyjson.com/product-images/tops/blue-frock/1.webp', 4.5),
    ('Dresses', 'Blue Denim Jeans', 1299.00, 'Classic blue denim jeans.', 'https://cdn.dummyjson.com/product-images/tops/girl-summer-dress/1.webp', 4.6),
    ('Dresses', 'Traditional Kurti', 1499.00, 'Elegant ethnic wear kurti.', 'https://cdn.dummyjson.com/product-images/tops/gray-dress/1.webp', 4.7),
    ('Dresses', 'Salwar Kameez Set', 1899.00, 'Complete chudidhar set.', 'https://cdn.dummyjson.com/product-images/tops/short-frock/1.webp', 4.8),
    ('Dresses', 'Silk Saree', 2999.00, 'Traditional Indian silk saree.', 'https://cdn.dummyjson.com/product-images/tops/tartan-dress/1.webp', 4.9),
    ('Dresses', 'Casual T-Shirt', 499.00, 'Comfortable daily wear.', 'https://cdn.dummyjson.com/product-images/womens-dresses/black-women\'s-gown/1.webp', 4.3),
    ('Dresses', 'Denim Shorts', 699.00, 'Stylish summer shorts.', 'https://cdn.dummyjson.com/product-images/womens-dresses/corset-leather-with-skirt/1.webp', 4.4),
    ('Dresses', 'Black Velvet Dress', 1599.00, 'Evening elegance.', 'https://cdn.dummyjson.com/product-images/womens-dresses/corset-with-black-skirt/1.webp', 4.8),
    ('Dresses', 'Leather Skirt', 1999.00, 'Chic black leather skirt.', 'https://cdn.dummyjson.com/product-images/womens-dresses/dress-pea/1.webp', 4.5),
    ('Dresses', 'Designer Summer Dress', 4999.00, 'Exclusive summer design.', 'https://cdn.dummyjson.com/product-images/womens-dresses/marni-red-&-black-suit/1.webp', 4.9),

    -- TOYS (Using dummyjson miscellaneous/home-decoration as proxies if needed, or reliable placeholders)
    ('Toys', 'Teddy Bear', 899.00, 'Soft cuddly teddy bear.', 'https://cdn.dummyjson.com/product-images/laptops/macbook-pro/1.webp', 4.7),
    ('Toys', 'Robot Toy', 599.00, 'Futuristic robot toy.', 'https://cdn.dummyjson.com/product-images/laptops/samsung-galaxy-book/1.webp', 4.9),
    ('Toys', 'Toy Car', 1299.00, 'Classic model car.', 'https://cdn.dummyjson.com/product-images/laptops/microsoft-surface-laptop-4/1.webp', 4.5),
    ('Toys', 'Building Blocks', 499.00, 'Creative construction set.', 'https://cdn.dummyjson.com/product-images/laptops/infinix-inbook/1.webp', 4.6),
    ('Toys', 'Miniature Car', 299.00, 'Detailed miniature.', 'https://cdn.dummyjson.com/product-images/laptops/hp-pavilion-15-dk1056wm/1.webp', 4.3),
    ('Toys', 'Plush Toy', 999.00, 'Soft plush animal.', 'https://cdn.dummyjson.com/product-images/fragrances/perfume-oil/1.webp', 4.4),
    ('Toys', 'Action Figure', 399.00, 'Hero figure.', 'https://cdn.dummyjson.com/product-images/fragrances/brown-perfume/1.webp', 4.5),
    ('Toys', 'Kids Kitchen Set', 1599.00, 'Kitchen play set.', 'https://cdn.dummyjson.com/product-images/fragrances/fog-scent-xpressio/1.webp', 4.8),
    ('Toys', 'Giraffe Toy', 799.00, 'Cute wooden giraffe.', 'https://cdn.dummyjson.com/product-images/fragrances/non-alcoholic-concentrated-perfume-oil/1.webp', 4.7),
    ('Toys', 'Wooden Train', 450.00, 'Classic wooden train.', 'https://cdn.dummyjson.com/product-images/fragrances/eau-de-perfume-spray/1.webp', 4.2),

    -- SKINCARE (Reliable paths)
    ('Skincare', 'Attitude Hand Soap', 150.00, 'Natural nourishing soap.', 'https://cdn.dummyjson.com/product-images/skin-care/attitude-super-leaves-hand-soap/1.webp', 4.5),
    ('Skincare', 'Olay Body Wash', 299.00, 'Moisturizing body wash.', 'https://cdn.dummyjson.com/product-images/skin-care/olay-ultra-moisture-shea-butter-body-wash/1.webp', 4.6),
    ('Skincare', 'Vaseline Lotion', 450.00, 'Deep moisture lotion.', 'https://cdn.dummyjson.com/product-images/skin-care/vaseline-men-body-and-face-lotion/1.webp', 4.8),
    ('Skincare', 'Luxury Serum', 599.00, 'Vitamin C serum.', 'https://cdn.dummyjson.com/product-images/skin-care/tree-oil-30ml/1.webp', 4.9),
    ('Skincare', 'Night Cream', 699.00, 'Rejuvenating night cream.', 'https://cdn.dummyjson.com/product-images/skin-care/rorec-white-rice-serum/1.webp', 4.7),
    ('Skincare', 'Hydrating Mask', 99.00, 'Aloe vera sheet mask.', 'https://cdn.dummyjson.com/product-images/skin-care/hyaluronic-acid-serum/1.webp', 4.4),
    ('Skincare', 'Body Lotion', 350.00, 'Cocoa butter lotion.', 'https://cdn.dummyjson.com/product-images/skin-care/oil-free-moisturizer-100ml/1.webp', 4.5),
    ('Skincare', 'Toner', 250.00, 'Rose water toner.', 'https://cdn.dummyjson.com/product-images/skin-care/serum-1/1.webp', 4.3),
    ('Skincare', 'Cleanser', 199.00, 'Foaming face wash.', 'https://cdn.dummyjson.com/product-images/skin-care/freckle-treatment-cream-15gm/1.webp', 4.4),
    ('Skincare', 'Herbal Cream', 120.00, 'Ayurvedic skin cream.', 'https://cdn.dummyjson.com/product-images/skin-care/daalish-anti-aging-eye-serum/1.webp', 4.2),

    -- MOBILES (Reliable)
    ('Mobiles', 'iPhone 15', 79900.00, 'Latest Apple iPhone 15.', 'https://cdn.dummyjson.com/product-images/smartphones/iphone-x/1.webp', 4.8),
    ('Mobiles', 'Samsung Galaxy S24 Ultra', 129999.00, 'Premium Android flagship.', 'https://cdn.dummyjson.com/product-images/smartphones/samsung-galaxy-book/1.webp', 4.8),
    ('Mobiles', 'POCO X6 Pro', 26999.00, 'High performance mid-ranger.', 'https://cdn.dummyjson.com/product-images/smartphones/oppo-f19/1.webp', 4.5),
    ('Mobiles', 'OPPO Reno 11 Pro', 39999.00, 'Stylish portrait expert.', 'https://cdn.dummyjson.com/product-images/smartphones/huawei-p30/1.webp', 4.6),
    ('Mobiles', 'Realme 12 Pro Plus', 29999.00, 'Luxury watch design.', 'https://cdn.dummyjson.com/product-images/smartphones/realme-c35/1.webp', 4.7),
    ('Mobiles', 'Redmi Note 13 Pro Plus', 31999.00, '200MP camera beast.', 'https://cdn.dummyjson.com/product-images/smartphones/iphone-12-pro/1.webp', 4.6),
    ('Mobiles', 'Vivo X100', 63999.00, 'Zeiss optics photography.', 'https://cdn.dummyjson.com/product-images/smartphones/realme-xt/1.webp', 4.8),
    ('Mobiles', 'iQOO 12', 52999.00, 'Ultimate gaming phone.', 'https://cdn.dummyjson.com/product-images/smartphones/samsung-galaxy-s10/1.webp', 4.7),
    ('Mobiles', 'Realme X', 16999.00, 'Impressive display.', 'https://cdn.dummyjson.com/product-images/smartphones/realme-x/1.webp', 4.5),
    ('Mobiles', 'Samsung Galaxy S8', 25999.00, 'Premium Infinity Display.', 'https://cdn.dummyjson.com/product-images/smartphones/samsung-galaxy-s8/1.webp', 4.6),

    -- GROCERY (Reliable)
    ('Grocery', 'Fresh Apple', 499.00, 'Crisp red apple.', 'https://cdn.dummyjson.com/product-images/groceries/apple/1.webp', 4.8),
    ('Grocery', 'Banana Bunch', 250.00, 'Fresh yellow bananas.', 'https://cdn.dummyjson.com/product-images/groceries/banana/1.webp', 4.5),
    ('Grocery', 'Whole Milk', 320.00, 'Organic whole milk.', 'https://cdn.dummyjson.com/product-images/groceries/milk/1.webp', 4.6),
    ('Grocery', 'Brown Eggs', 420.00, 'Farm fresh brown eggs.', 'https://cdn.dummyjson.com/product-images/groceries/eggs/1.webp', 4.7),
    ('Grocery', 'Cheddar Cheese', 650.00, 'Aged cheddar cheese.', 'https://cdn.dummyjson.com/product-images/groceries/cheese/1.webp', 4.8),
    ('Grocery', 'Whole Wheat Bread', 300.00, 'Healthy wheat bread.', 'https://cdn.dummyjson.com/product-images/groceries/bread/1.webp', 4.4),
    ('Grocery', 'Basmati Rice', 1200.00, 'Premium basmati rice.', 'https://cdn.dummyjson.com/product-images/groceries/rice/1.webp', 4.9),
    ('Grocery', 'Orange Juice', 399.00, 'Freshly squeezed juice.', 'https://cdn.dummyjson.com/product-images/groceries/juice/1.webp', 4.5),
    ('Grocery', 'Ground Coffee', 799.00, 'Aromatic ground coffee.', 'https://cdn.dummyjson.com/product-images/groceries/coffee/1.webp', 4.7),
    ('Grocery', 'Green Tea', 550.00, 'Antioxidant green tea.', 'https://cdn.dummyjson.com/product-images/groceries/tea/1.webp', 4.6);";

    $pdo->exec($sql);
    echo "Database successfully populated with reliable images!<br>";

    // 4. Re-enable FK checks
    $pdo->exec("SET FOREIGN_KEY_CHECKS=1");

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
