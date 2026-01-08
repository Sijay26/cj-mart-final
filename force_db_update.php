<?php
require 'db.php';

$sql = "
-- (Include the full SQL content here again because I cannot rely on file_get_contents if path issues exist)
DROP TABLE IF EXISTS products;
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(50) NOT NULL,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    image VARCHAR(255) NOT NULL,
    description TEXT,
    rating FLOAT DEFAULT 4.5
);

INSERT INTO products (category, name, price, description, image, rating) VALUES
('Dresses', 'Floral Summer Dress', 1299.00, 'Light and breezy.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Floral+Dress', 4.5),
('Dresses', 'Party Wear Gown', 2999.00, 'Elegant gown.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Party+Gown', 4.8),
('Dresses', 'Casual Cotton Dress', 799.00, 'Comfortable cotton.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Cotton+Dress', 4.2),
('Dresses', 'Ethnic Kurti', 599.00, 'Traditional kurti.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Ethnic+Kurti', 4.4),
('Dresses', 'Maxi Dress', 1499.00, 'Long flowing dress.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Maxi+Dress', 4.6),
('Dresses', 'Designer Gown', 4999.00, 'Exclusive gown.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Designer+Gown', 4.9),
('Dresses', 'Western Short Dress', 999.00, 'Stylish short dress.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Short+Dress', 4.3),
('Dresses', 'Printed Daily Wear', 699.00, 'Simple printed dress.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Printed+Dress', 4.1),
('Dresses', 'Office Wear Dress', 1299.00, 'Formal office dress.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Office+Dress', 4.5),
('Dresses', 'Evening Wear Dress', 1899.00, 'Sophisticated evening.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Evening+Dress', 4.7),

('Mobiles', 'Android 5G Phone', 15999.00, 'High speed 5G.', 'https://placehold.co/300x300/000000/ffffff?text=Android+5G', 4.6),
('Mobiles', 'Flagship Smartphone', 45999.00, 'Top specs.', 'https://placehold.co/300x300/000000/ffffff?text=Flagship', 4.9),
('Mobiles', 'Camera Focus Mobile', 22999.00, 'Best camera.', 'https://placehold.co/300x300/000000/ffffff?text=Camera+Mobile', 4.7),
('Mobiles', 'Gaming Smartphone', 35999.00, 'For gaming.', 'https://placehold.co/300x300/000000/ffffff?text=Gaming+Phone', 4.8),
('Mobiles', 'Budget Android Phone', 7999.00, 'Affordable.', 'https://placehold.co/300x300/000000/ffffff?text=Budget+Phone', 4.2),
('Mobiles', 'Premium Glass Phone', 29999.00, 'Glass design.', 'https://placehold.co/300x300/000000/ffffff?text=Premium+Phone', 4.5),
('Mobiles', 'Dual Camera Phone', 12999.00, 'Dual cameras.', 'https://placehold.co/300x300/000000/ffffff?text=Dual+Camera', 4.3),
('Mobiles', 'Battery Long-life Phone', 10999.00, '6000mAh battery.', 'https://placehold.co/300x300/000000/ffffff?text=Battery+Phone', 4.4),
('Mobiles', 'Compact Smartphone', 18999.00, 'Small size.', 'https://placehold.co/300x300/000000/ffffff?text=Compact+Phone', 4.5),
('Mobiles', 'AI Feature Phone', 25999.00, 'AI powered.', 'https://placehold.co/300x300/000000/ffffff?text=AI+Phone', 4.6),

('Toys', 'Remote Control Car', 899.00, 'RC car.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=RC+Car', 4.7),
('Toys', 'Teddy Bear', 599.00, 'Soft teddy.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Teddy+Bear', 4.9),
('Toys', 'Doll Set', 1299.00, 'Doll + accessories.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Doll+Set', 4.5),
('Toys', 'Building Blocks', 499.00, 'Construction set.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Building+Blocks', 4.6),
('Toys', 'Puzzle Toy', 299.00, 'Brain teaser.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Puzzle', 4.3),
('Toys', 'Robot Toy', 999.00, 'Walking robot.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Robot', 4.4),
('Toys', 'Action Figure', 399.00, 'Hero figure.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Action+Figure', 4.5),
('Toys', 'Kids Kitchen Set', 1599.00, 'Kitchen play.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Kitchen+Set', 4.8),
('Toys', 'Learning Toy', 799.00, 'Educational.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Learning+Toy', 4.7),
('Toys', 'Musical Toy', 450.00, 'Plays music.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Musical+Toy', 4.2),

('Grocery', 'Rice Bag', 499.00, '5kg Rice.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Rice+Bag', 4.8),
('Grocery', 'Cooking Oil', 180.00, '1L Oil.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Cooking+Oil', 4.5),
('Grocery', 'Snack Packets', 50.00, 'Chips.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Snacks', 4.3),
('Grocery', 'Fresh Vegetables', 150.00, 'Vegetables.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Vegges', 4.7),
('Grocery', 'Fresh Fruits', 250.00, 'Fruits.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Fruits', 4.9),
('Grocery', 'Milk Pack', 60.00, '1L Milk.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Milk', 4.6),
('Grocery', 'Spice Masala', 80.00, 'Spices.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Spices', 4.5),
('Grocery', 'Instant Noodles', 20.00, 'Noodles.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Noodles', 4.4),
('Grocery', 'Breakfast Cereals', 350.00, 'Cereals.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Cereals', 4.6),
('Grocery', 'Household Items', 199.00, 'Cleaning.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Household', 4.2),

('Skincare', 'Face Wash', 150.00, 'Face wash.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Face+Wash', 4.5),
('Skincare', 'Moisturizer', 299.00, 'Cream.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Moisturizer', 4.6),
('Skincare', 'Sunscreen', 450.00, 'SPF 50.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Sunscreen', 4.8),
('Skincare', 'Vitamin C Serum', 599.00, 'Serum.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Vit+C', 4.9),
('Skincare', 'Night Cream', 699.00, 'Night repair.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Night+Cream', 4.7),
('Skincare', 'Face Mask', 99.00, 'Mask.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Face+Mask', 4.4),
('Skincare', 'Body Lotion', 350.00, 'Lotion.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Body+Lotion', 4.5),
('Skincare', 'Toner', 250.00, 'Toner.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Toner', 4.3),
('Skincare', 'Cleanser', 199.00, 'Cleanser.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Cleanser', 4.4),
('Skincare', 'Herbal Cream', 120.00, 'Herbal.', 'https://placehold.co/300x300/ff5fa2/ffffff?text=Herbal', 4.2);
";

try {
    $pdo->exec($sql);
    echo "<h1>Database Force Updated!</h1>";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
