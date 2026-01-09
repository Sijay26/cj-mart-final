<?php
// force_update_dresses.php
include 'db.php';

echo "Starting Dresses Update (PDO Mode)...<br>";

if (!isset($pdo)) {
    die("Error: Database connection object \$pdo not found check db.php");
}
echo "DB Connected.<br>";

try {
    // 1. Disable FK Checks
    $pdo->exec("SET FOREIGN_KEY_CHECKS=0");
    
    // 2. Clear old Dresses
    $sql_delete = "DELETE FROM products WHERE category = 'Dresses'";
    $pdo->exec($sql_delete);
    echo "Old 'Dresses' deleted successfully.<br>";

    // 3. Insert New Dresses
    $sql_insert = "INSERT INTO products (category, name, price, description, image, rating) VALUES
    ('Dresses', 'Classic White Shirt', 899.00, 'Formal women\'s button-up shirt.', 'https://images.unsplash.com/photo-1598554747436-c9293d6a588f?auto=format&fit=crop&w=400&q=80', 4.5),
    ('Dresses', 'Blue Denim Jeans', 1299.00, 'Classic blue denim jeans.', 'https://images.unsplash.com/photo-1541099649105-f69ad21f3246?auto=format&fit=crop&w=400&q=80', 4.6),
    ('Dresses', 'Traditional Kurti', 1499.00, 'Elegant ethnic wear kurti.', 'https://images.unsplash.com/photo-1583391725988-64305c4506b3?auto=format&fit=crop&w=400&q=80', 4.7),
    ('Dresses', 'Salwar Kameez Set', 1899.00, 'Complete chudidhar set.', 'https://images.unsplash.com/photo-1631541913757-b08e75db7201?auto=format&fit=crop&w=400&q=80', 4.8),
    ('Dresses', 'Silk Saree', 2999.00, 'Traditional Indian silk saree.', 'https://images.unsplash.com/photo-1610030469983-98e550d6193c?auto=format&fit=crop&w=400&q=80', 4.9),
    ('Dresses', 'Casual T-Shirt', 499.00, 'Comfortable cotton t-shirt.', 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=400&q=80', 4.3),
    ('Dresses', 'Denim Shorts', 699.00, 'Summer denim shorts.', 'https://images.unsplash.com/photo-1591195853828-11db59a44f6b?auto=format&fit=crop&w=400&q=80', 4.4),
    ('Dresses', 'Black Velvet Dress', 1599.00, 'Elegant black velvet dress.', 'https://images.unsplash.com/photo-1539008835657-9e8e9680c956?auto=format&fit=crop&w=400&q=80', 4.8),
    ('Dresses', 'Leather Skirt', 1999.00, 'Stylish black leather skirt.', 'https://images.unsplash.com/photo-1550614000-4b9519e07297?auto=format&fit=crop&w=400&q=80', 4.5),
    ('Dresses', 'Designer Summer Dress', 4999.00, 'Exclusive summer design.', 'https://images.unsplash.com/photo-1515372039744-b8f02a3ae446?auto=format&fit=crop&w=400&q=80', 4.9)";

    $pdo->exec($sql_insert);
    echo "New 'Dresses' inserted successfully.<br>";
    
    // 4. Re-enable FK Checks
    $pdo->exec("SET FOREIGN_KEY_CHECKS=1");

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "<br>";
}

echo "Update Complete.";
?>
