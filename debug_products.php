<?php
require 'db.php';

try {
    // 1. Check connection
    echo "<h2>Database Connection</h2>";
    echo "Connected successfully to " . $dbname . "<br>";

    // 2. Count products
    $stmt = $pdo->query("SELECT COUNT(*) FROM products");
    $count = $stmt->fetchColumn();
    echo "Total Products in DB: <strong>" . $count . "</strong><br>";

    // 3. Check Categories
    echo "<h2>Categories Found</h2>";
    $stmt = $pdo->query("SELECT DISTINCT category FROM products");
    $categories = $stmt->fetchAll(PDO::FETCH_COLUMN);
    if ($categories) {
        echo "<ul>";
        foreach ($categories as $cat) {
            echo "<li>" . htmlspecialchars($cat) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "No categories found.<br>";
    }

    // 4. Dump first 5 products
    echo "<h2>First 5 Products</h2>";
    $stmt = $pdo->query("SELECT * FROM products LIMIT 5");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($products) {
        echo "<pre>" . print_r($products, true) . "</pre>";
    } else {
        echo "<strong>Products table is empty!</strong>";
    }

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
