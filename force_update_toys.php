<?php
// force_update_toys.php
include 'db.php';

echo "Starting Toys Update (PDO Mode)...<br>";

if (!isset($pdo)) {
    die("Error: Database connection object \$pdo not found check db.php");
}
echo "DB Connected.<br>";

try {
    // 1. Disable FK Checks
    $pdo->exec("SET FOREIGN_KEY_CHECKS=0");
    
    // 2. Clear old Toys
    $sql_delete = "DELETE FROM products WHERE category = 'Toys'";
    $pdo->exec($sql_delete);
    echo "Old 'Toys' deleted successfully.<br>";

    // 3. Insert New Toys
    $sql_insert = "INSERT INTO products (category, name, price, description, image, rating) VALUES
    ('Toys', 'Teddy Bear', 899.00, 'Soft cuddly teddy bear.', 'https://images.unsplash.com/photo-1559715541-5daf8a0296d0?auto=format&fit=crop&w=400&q=80', 4.7),
    ('Toys', 'Robot Toy', 599.00, 'Futuristic robot toy.', 'https://images.unsplash.com/photo-1596461404969-9ae70f2830c1?auto=format&fit=crop&w=400&q=80', 4.9),
    ('Toys', 'Toy Car', 1299.00, 'Classic model car.', 'https://images.unsplash.com/photo-1581557991964-125469da3b8a?auto=format&fit=crop&w=400&q=80', 4.5),
    ('Toys', 'Building Blocks', 499.00, 'Creative construction set.', 'https://images.unsplash.com/photo-1587654780291-39c940483713?auto=format&fit=crop&w=400&q=80', 4.6),
    ('Toys', 'Miniature Car', 299.00, 'Detailed miniature.', 'https://images.unsplash.com/photo-1566576912321-d58ddd7a6047?auto=format&fit=crop&w=400&q=80', 4.3),
    ('Toys', 'Plush Toy', 999.00, 'Soft plush animal.', 'https://images.unsplash.com/photo-1559715541-5daf8a0296d0?auto=format&fit=crop&w=400&q=80', 4.4),
    ('Toys', 'Action Figure', 399.00, 'Hero figure.', 'https://images.unsplash.com/photo-1632733923052-a9b0c7835847?auto=format&fit=crop&w=400&q=80', 4.5),
    ('Toys', 'Kids Kitchen Set', 1599.00, 'Kitchen play set.', 'https://images.unsplash.com/photo-1596461404969-9ae70f2830c1?auto=format&fit=crop&w=400&q=80', 4.8),
    ('Toys', 'Giraffe Toy', 799.00, 'Cute wooden giraffe.', 'https://images.unsplash.com/photo-1599623560574-39d485900c95?auto=format&fit=crop&w=400&q=80', 4.7),
    ('Toys', 'Wooden Train', 450.00, 'Classic wooden train.', 'https://images.unsplash.com/photo-1596461404969-9ae70f2830c1?auto=format&fit=crop&w=400&q=80', 4.2)";

    $pdo->exec($sql_insert);
    echo "New 'Toys' inserted successfully.<br>";
    
    // 4. Re-enable FK Checks
    $pdo->exec("SET FOREIGN_KEY_CHECKS=1");

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "<br>";
}

echo "Update Complete.";
?>
